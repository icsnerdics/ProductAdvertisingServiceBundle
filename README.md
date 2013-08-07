ProductAdvertisingServiceBundle

USAGE MEANS SAUSAGE:

0) Register the bundle! $bundles[] = new RobertoDormePoco\ProductAdvertisingServiceBundle\RobertoDormePocoProductAdvertisingServiceBundle()

1) Get the service! $pas = $this->container->get('aws_pas_manager');

2) Dream about some nasty keywords! $keywords = array('varnelli', 'marmite', 'pizzettarossa');

3) Request da shi*! $pasResponse = file_get_contents($pas->ItemSearch('Food(?!)', $keywords));

4) Parse da shi*! $xmlPasResponse = simplexml_load_string($pasResponse);

5) ?

6) PROFIT!!1!1ONE1!!!

