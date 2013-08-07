ProductAdvertisingServiceBundle
=

This Symfony2 bundle helps you out (me first) to deal with the Amazon Product Advertising Service API

USAGE MEANS SAUSAGE:
-

        0) Register the bundle! $bundles[] = new RobertoDormePoco\ProductAdvertisingServiceBundle\RobertoDormePocoProductAdvertisingServiceBundle()
        
        1) Get the service! $pas = $this->container->get('aws_pas_manager');
        
        2) Dream about some nasty keywords! $keywords = array('varnelli', 'marmite', 'pizzettarossa');
        
        3) Request da shi*! $pasResponse = file_get_contents($pas->ItemSearch('Food(?!)', $keywords));
        
        4) Parse da shi*! $xmlPasResponse = simplexml_load_string($pasResponse);
        
        5) ?
        
        6) PROFIT!!1!1ONE1!!!

License
-

                  DO WHAT THE FUCK YOU WANT TO PUBLIC LICENSE
                          Version 2, December 2004
        
        Copyright (C) 2004 Sam Hocevar <sam@hocevar.net>
        
        Everyone is permitted to copy and distribute verbatim or modified
        copies of this license document, and changing it is allowed as long
        as the name is changed.
        
                  DO WHAT THE FUCK YOU WANT TO PUBLIC LICENSE
         TERMS AND CONDITIONS FOR COPYING, DISTRIBUTION AND MODIFICATION
        
        0. You just DO WHAT THE FUCK YOU WANT TO.
