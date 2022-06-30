<?php
namespace App\Service;

use Pimcore\Model\{DataObject,Element};
use Carbon\Carbon;

class CustomerSeeder implements SeederInterface
{
    public function seed(array $customers)
    {
        // exit;
        $this->deleteAllCustomers();
        foreach($customers as $customer)
        {
            $customerDirId = 14; // ID for the customer directory in data object
            $customerNameUnique = $customer['firstname'] . "_" .$customer['lastname'] . bin2hex(random_bytes(4));
            $obj = new DataObject\Customer;
            
            $obj->setKey(Element\Service::getValidKey($customerNameUnique, 'object'));
            $obj->setParentId($customerDirId);
            
            $fname = $customer['firstname'];
            $lname = $customer['lastname'];
            $email = $customer['email'];
            $group = $customer['group'];
            $status = $customer['status'];
            $regDate = !empty($customer['regDate']) ?  Carbon::parse($customer['regDate']) : Carbon::now();
            // var_dump($regDate);exit;
            $customerIsNotExpired = !(strcmp($status, "Expired") === 0);
            $obj->setFirstname($fname)
                ->setLastname($lname)
                ->setEmail($email)
                ->setGroup($group)
                ->setStatus($status)
                ->setReg_date($regDate)
                ->setPublished($customerIsNotExpired)
                ->save();
        }
    }
    /**
     * Delete all the customer data object (published or unpublished)
     * 
     */
    private function deleteAllCustomers()
    {
       $customers = new DataObject\Customer\Listing();
       $customers->setUnpublished(true);
       foreach($customers as $customer){
        var_dump($customer->getId());
        $customer->delete();
       }
    }
}