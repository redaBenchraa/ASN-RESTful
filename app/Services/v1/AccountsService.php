<?php

namespace App\Services\v1;

use App\Account;
use App\Comment;
use App\Grp;
use phpDocumentor\Reflection\Types\Null_;

class AccountsService{
        protected $supportedFields = [
            'createGroup' => 'createdGroups'
        ];
        public function getAccounts($params){
            $includes = [];
            $withKeys = [];
            if(empty($params)){
                return $this->filterAccounts(Account::all(),$withKeys);
            }
            if(isset($params['include'])){
                $includeParams = explode(',',$params['include']);
                $includes = array_intersect($this->supportedFields,$includeParams);
                $withKeys = array_keys($includes);
            }
            return $this->filterAccounts(Account::with($withKeys)->get(),$withKeys);
        }
        public function getAccount($idAccount){
            $withKeys = [];
            return $this->filterAccounts(Account::where('id',$idAccount)->get(),$withKeys);
        }
        protected function filterAccounts($Accounts,$withKeys){
            $data = [];
            foreach ($Accounts as $Account){

                $entry = [
                    'firstName' => $Account->firstName,
                    'lastName' => $Account->lastName,
                    'Email' => $Account->Email,
                    'About' => $Account->About,
                    'showEmail' => $Account->showEmail,
                    'Image' => $Account->Image,
                    'href' => route('Accounts.show',['id'=>$Account->idAccount]),
                ];
                if(in_array('createGroup',$withKeys)){
                    $Groups = $Account->createGroup;
                    $createdGroups =[];
                    foreach ($Groups as $group) {
                        $grp = [
                            'Name' => $group->Name,
                            'About' => $group->About,
                            'createdDate' =>$group->creationDate
                        ];
                        $createdGroups[] = $grp;
                    }
                    $entry['createdGroups'] = $createdGroups;
                }
                $data[] = $entry;
            }
            return $data;
        }
    }
