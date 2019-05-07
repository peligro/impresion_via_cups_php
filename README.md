# impresion_via_cups_php

Con este script se podrá imprimir desde PHP 7 a través del uso de CUPS.
Se podrá:

- Listar impresoras de la red
- Listar trabajos completados de una impresora determinada
- Enviar a imprimir documentos a una impresora específica

$ImprimirViaCups=new ImprimirViaCups();
//echo $ImprimirViaCups->imprimir('helloworld.pdf', 'luchito');//imprimir archivo
//print_r($ImprimirViaCups->listarTrabajosPorImpresora('luchito'));//listar trabajos completados por impresora
print_r($ImprimirViaCups->listarImpresoras());//listar impresoras