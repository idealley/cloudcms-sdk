# Cloud CMS SDK for PHP
[Cloud CMS](https://www.cloudcms.com/) is a "headless" CMS.

### This is a framework agnostic PHP SDK. 
[Here is the Laravel5  wrapper](https://github.com/idealley/cloudcms-laravel)

### What can it do

For now the SDK allows to read content from CloudCms as well as to write/update a node. We will be adding more features, but for now the SDK allows to create a full fonctional website using Cloud CMS as content management.

## How to install

`composer require idealley/cloudcms-sdk`

# Main available methods

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

__Refer to `repository/Node.php` to see all available methods. They are documented with working examples__

### Model (Schema)

In order to simplyfy the display of the content you can save the model (schema) from Cloud CMS locally. Then when you have a sucessfull request you can compare it to the model. All properties are available and you do not need to check if they are set. 

This method will get the model and save it locally

        CC::setModel('your:content-type');

This method will delet the model (when you update it in Cloud CMS)
        
        CC::setModel('your:content-type');

Here is an example of parsing

            foreach ($items as $key => $i){
                // You can do it as the commented lign if you do use Cloud CMS array elements (repeatable elements in the interface)
                //$item += $this->model;
                //If not do it like this
                $item = array_replace_recursive($this->model, $i);
                [...]
                // you can then work on your fields for example to parse markdown
                // the $item has ben objectified before hand
                $item->body = Markdown::parse($item->body);
                //but you could do it like this if your prefer to work on an array
                $item['body'] = Markdown::parse($item['body']);



### Todo

* Use a proxy url to fetch the images/documents
* add more methods

### Get documents and images stored in Cloud CMS

* Get images you with the node.js server developped by Cloud CMS to fetch and cache the images you need.
* Deploy an application and use the deployement url
