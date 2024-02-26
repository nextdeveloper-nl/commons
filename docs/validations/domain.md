# Domain Ownership Validation via DNS Record

## Overview

This document serves as a guide on how to validate domains for reachability, registration status and ownership using the DNS TXT method. It provides step-by-step instructions on leveraging PHP's DNS interaction capabilities to query DNS records, check domain availability, retrieve expiration information, and verify registration status.

## Flow of Program

### Validate Domaim

After user adds domain, an instance of the whois class is initialized to check domain registration information and a connection attempt is sent to validate if the domain is reachable, if the response fulfills our requirement (domain must be reachable and registered), domain would be marked as reachable and a unique, secure token of a suitable length (40 characters) would be stored along side.

### Validate Domain Ownership

The generated unique token would be provided to the user together with instructions on how to validate the ownership by adding the it a TXT record to the DNS Records.
The user arrives back on the site after adding the record. A Job to query the user's domain's TXT records using appropriate DNS lookup methods would be initiated to extract the TXT record values and search for an exact match with the provided token. if the response fulfills our requirement (token found), domain woule become attached to user and marked as ownership verified. If not we provide clear error messages and allow for re-initiating the process

## Code

- After validatin that user domain is registered and reachable, we generate a unique 40 digits token and attach to the domain

```php
    if($this->validatable['validation_data']['is_reachable']){
                
        $this->model->update([
            'is_reachable' => true,
        ]);
        $this->validatable->update([
            'validation_data'   =>  [
                'dns_token' => Str::random(40),
            ],
        ]);
    }

```

- Unique Code and instructions in provided to user, after which the `ValidateOwnershipWithHttp` class gets triggered  with a domain instance as parameters

```php
/**
 * @todo: Write comments
 *
 * @param Domains $model
 * 
 */
```

- The Validatables of the domain would be retrieved, if exists: continue, else abort with progress set to 100 and reason for aborting

```php
 if ($this->model) {
    $validatable = Validatables::where('object_id', $this->model->id)
                            ->where('object_type', get_class($this->model))
                            ->first();
    if($validatable && $this->model->is_reachable){

        // Set progress to 50% and start checking the domain ownership
        $this->setProgress(50, 'Checking domain ownership');

        // Code to check DNS
        
    }else{
        //Set progress to 100% and indicate that the domain was found but not reachable
        $this->setProgress(100, 'Domain found but not reachable');

    }

    
    // Set progress to 100% and indicate that the domain was found and validated
    $this->setProgress(100, 'Domain found and validated');
}else{
    // Set progress to 100% and indicate that the domain was not found
    $this->setProgress(100, 'Domain not found');
}

```

- Replace the Commment `Code to check DNS` with the code that retrieves the 40 unique character from the domain valitables and also the DNS record from the user domain name

```php
$domainDnsToken = $validatable->validation_data['dns_token'];

$checkDnsRecords = dns_get_record($this->model->name, TXT);
if ($checkDnsRecords !== false) {
    foreach ($checkDnsRecords as $record) {
        // Display each TXT record found
        if($record['txt'] == $domainDnsToken){
            // Set progress to 100% and indicate that the TXT was found and Ownership is validated
            $this->setProgress(100, 'TXT found and Ownership Validated');
        }else{
            // Set progress to 100% and indicate that the TXT Record Not Found
            $this->setProgress(100, 'TXT Record Not Found');
        }
    }
} else {

    // No TXT records found for the domain
    $this->setProgress(100, 'Domain found but No TXT records found for the domain');

}

```

The code above checks compares the retrieved 40 unique character to all existing domain TXT record and if one matches, It sets domain ownership validation to true, If not sets the appropriate error.
