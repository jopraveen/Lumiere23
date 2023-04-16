<?php
libxml_disable_entity_loader (false);

$xmlData = file_get_contents("php://input");

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $xmlData = preg_replace('/<!DOCTYPE[^>]*>/', '', $xmlData);
    $xmlData = preg_replace('/<!ENTITY.*?>/', '', $xmlData);
    $xmlData = preg_replace('/<!\[CDATA\[.*?\]\]>/s', '', $xmlData);
    $xmlData = preg_replace('/<xi:include.*?>/si', '', $xmlData);
    $xmlData = preg_replace('/xsi:schemaLocation\s*=\s*[\'"][^\'"]*[\'"]/i', '', $xmlData);
    $xmlData = preg_replace('/<!--.*?-->/s', '', $xmlData);
    $xmlData = preg_replace('/[^\x09\x0A\x0D\x20-\x7F]/', '', $xmlData);

}

else {
    // Only POST requests are accepted";
    http_response_code(500);
    header('Location: /cheater.php');
}

$doc = new DOMDocument();
$doc->loadXML($xmlData,LIBXML_NOENT);
$xml = simplexml_import_dom($doc);

// extract form data
$firstName = (string) $xml->{"fname"};
$lastName = (string) $xml->{"lname"};
$salary = (string) $xml->{"salary"};
$description = (string) $xml->{"description"};

// response
echo "
<br><br><br>
<div align='center'>
<h1 class='mb-4 text-4xl font-extrabold leading-none tracking-tight text-gray-900 md:text-5xl lg:text-6xl dark:text-white'>We will contact you soon!</h1>
<p class='mb-6 text-lg font-normal text-gray-500 lg:text-xl sm:px-16 xl:px-48 dark:text-gray-400'>
Hey $firstName, Thanks for applying!
</p>
<a href='/' class='inline-flex items-center justify-center px-5 py-3 text-base font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 dark:focus:ring-blue-900'>
    Return to Home
    <svg class='w-5 h-5 ml-2 -mr-1' fill='currentColor' viewBox='0 0 20 20' xmlns='http://www.w3.org/2000/svg'><path fill-rule='evenodd' d='M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z' clip-rule='evenodd'></path></svg>
</a>
</div>
<br><br><br>
";


?>
<!--  end handling -->