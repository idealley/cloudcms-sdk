# Cloud CMS SDK for PHP
[Cloud CMS](https://www.cloudcms.com/) is a "headless" CMS.

### This is a framework agnostic PHP SDK. 
[Here is the Laravel5  wrapper](https://github.com/idealley/cloudcms-laravel)

### What can it do

For now the SDK allows to read content from CloudCms as well as to write/update a node. We will be adding more features, but for now the SDK allows to create a full fonctional website using Cloud CMS as content management.

## How to install

`composer require idealley/cloudcms-sdk`

# Every thing is still very experimental and subject to CHANGE

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

You can chain any params as per [the documentation](https://www.cloudcms.com/documentation/application-server/services/node-urls.html) 

Refer to `repository/Node.php` to see all available methods. They are documented with working examples 

### Todo

* Use a proxy url to fetch the images/documents
* add more methods

### Get documents and images stored in Cloud CMS

* Get images you with the node.js server developped by Cloud CMS to fetch and cache the images you need.
* Deploy an application and use the deployement url
