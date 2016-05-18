# Cloud CMS SDK for PHP

###This is (will be) a framework agnostic PHP SDK. 

## How to install

`composer require idealley/cloudcms-sdk`

## Todo

Everything...

# Every thing is still very experimental and subject to CHANGE

CC is a Laravel Facade, if you do not use Laravel you can just new up the class.

You can get a children of a node like this (think category or list of blogs)

        $catnode = 'o:9a8195e6286a4f7b40ae';
   
        $nodes = CC::nodes()
                ->listChildren($catnode)
                ->addParams(['full' => 'true'])
                ->get(); 

Or a single node (for now we are getting it from a special slug field) like this:

        $node = CC::nodes()
                    ->find($slug)
                    ->addParams(['full' => 'true'])   
                    ->get();

You can chain paramas

        $node = CC::nodes()
                    ->find($slug)
                    ->addParams(['full' => 'true']) 
                    ->addParams(['metadata' => 'true'])   
                    ->get();           

or pass them in a single array

                    ->addParams(['full' => 'true', 'metadata' => 'true']) 

You can get an image like this

        $path = 'Samples/Catalog/Products/';            
        $img = CC::nodes()
                    ->getImage($node['rows'][0]['_qname'])
                    ->addParams(['name' => $node['rows'][0]['_features']['f:filename']['filename']])
                    ->addParams(['size' => '400'])
                    ->set();

We need to get the path programatically. You can chain any params as per [the documentation](https://www.cloudcms.com/documentation/application-server/services/node-urls.html) 
