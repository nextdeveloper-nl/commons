<?php
/**
 * This file was part of the PlusClouds.Core library but now its migrated to
 * NextDeveloper.Commons
 *
 * (c) Semih Turna <semih.turna@plusclouds.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace NextDeveloper\Commons\Database\Traits;

use Illuminate\Support\Facades\Log;
use NextDeveloper\Commons\Helpers\StateHelper;
use phpseclib3\Net\SSH2;

/*
 * This trait creates SSH Connections
 */

trait SSHable
{
    public function performMultipleSSHCommands($commands)
    {
        $ipAddr = $this->ip_addr;
        $ipAddr = explode('/', $ipAddr);
        $ipAddr = $ipAddr[0];

        $connection = new SSH2($ipAddr, $this->ssh_port, 10);
        $isLoggedIn = $connection->login($this->ssh_username, decrypt($this->ssh_password));

        $response = [];

        foreach ($commands as $c) {
            $output = null;
            $error = '';
            try {
                Log::debug(__METHOD__ . ' | Running command: ' . $c);

                $output = trim($connection->read());
                $connection->setTimeout(1);

                $connection->write($c . "\n");
                $connection->setTimeout(1);

                $output = $connection->read();
                $connection->setTimeout(1);

                Log::debug(__METHOD__ . ' | Result is: ' . $output);
            } catch (\Exception $e) {
                Log::error(__METHOD__ . ' | We got the error with this command: ' . $c);
                Log::error(__METHOD__ . ' | Went into exception with error: ' . $e->getMessage());
            }

            $response[] = [
                'output'    =>  $output,
                'error'     =>  trim($error),
            ];
        }

        return $response;
    }

    public function performSSHCommand($command)
    {
        $connection = $this->createSSHConnection();

        if(!$connection)
            throw new \Exception('I cannot connect to the SSH you have provided. Check the ' .
                'IP (' . $this->ip_v4 . ') and the credentials, please.');

        $response = [];

        if(!is_array($command))
            $command = [$command];

        foreach ($command as $c) {
            $out = '';
            $error = '';
            $this->ssh2Run($connection, $c, $out, $error);

            $response[] = [
                'output'    =>  trim($out),
                'error'     =>  trim($error)
            ];
        }

        return $response;
    }

    private function ssh2Run($ssh2,$cmd,&$out=null,&$err=null){
        $result=false;
        $out='';
        $err='';
        $sshout=ssh2_exec($ssh2,$cmd);

        if($sshout){
            $ssherr=ssh2_fetch_stream($sshout,SSH2_STREAM_STDERR);

            if($ssherr){
                # we cannot use stream_select() with SSH2 streams
                # so use non-blocking stream_get_contents() and usleep()
                if(stream_set_blocking($sshout,false) and
                    stream_set_blocking($ssherr,false)
                ){
                    $result=true;
                    # loop until end of output on both stdout and stderr
                    $wait=0;
                    while(!feof($sshout) or !feof($ssherr)){
                        # sleep only after not reading any data
                        if($wait)usleep($wait);
                        $wait=50000; # 1/20 second
                        if(!feof($sshout)){
                            $one=stream_get_contents($sshout);
                            if($one===false){ $result=false; break; }
                            if($one!=''){ $out.=$one; $wait=0; }
                        }
                        if(!feof($ssherr)){
                            $one=stream_get_contents($ssherr);
                            if($one===false){ $result=false; break; }
                            if($one!=''){ $err.=$one; $wait=0; }
                        }
                    }
                }
                # we need to wait for end of command
                stream_set_blocking($sshout,true);
                stream_set_blocking($ssherr,true);
                # these will not get any output
                stream_get_contents($sshout);
                stream_get_contents($ssherr);
                fclose($ssherr);
            }
            fclose($sshout);
        }
        return $result;
    }

    /**
     * @throws \Throwable
     */
    public function createSSHConnection()
    {
        $result = $this->checkSSHPort();

        if($result['status'] === false)
            return null;

        $ipAddr = $this->ip_addr;
        $ipAddr = explode('/', $ipAddr);
        $ipAddr = $ipAddr[0];

        try {
            $connection = ssh2_connect($ipAddr, $this->ssh_port);
            ssh2_auth_password($connection, $this->ssh_username, decrypt($this->ssh_password));
        } catch (\ErrorException $e) {
            if($e->getMessage() == 'ssh2_auth_password(): Authentication failed for root using password') {
                StateHelper::setState($this, 'ssh_connection', 'Authentication failed! Please check your ssh username and password.', StateHelper::STATE_ERROR);
                return null;
            }
            return null;
        }

        StateHelper::setState($this, 'ssh_connection', 'successful', StateHelper::STATE_SUCCESS);

        return $connection;
    }

    public function checkSSHPort($timeout = 30)
    {
        $errCode = 0;
        $errMessage = '';

        $ipAddr = $this->ip_addr;
        $ipAddr = explode('/', $ipAddr);
        $ipAddr = $ipAddr[0];

        if(config('leo.debug.ssh.connection'))
            Log::debug('[SSHable] Trying to connect to ssh port: ' . $ipAddr . ':' . $this->ssh_port . ' with timeout: ' . $timeout . ' seconds.');

        $connection = @fsockopen($ipAddr, $this->ssh_port, $errCode, $errMessage, 30);

        if(is_resource($connection))
        {
            fclose($connection);
            StateHelper::setState($this, 'ssh_connection', 'successful', StateHelper::STATE_SUCCESS);
            return ['status' => true];
        }

        $this->update([
            'has_warning' => true
        ]);

        StateHelper::setState($this, 'ssh_connection', 'Cannot reach to ssh port! Error message: ' . $errMessage, StateHelper::STATE_ERROR);

        return ['status' => false, 'message' => $errMessage];
    }
}
