<?php
error_reporting(E_ALL);ini_set("display_errors",1);
require_once('cups/autoload.php');
use Smalot\Cups\Builder\Builder;
use Smalot\Cups\Manager\JobManager;
use Smalot\Cups\Manager\PrinterManager;
use Smalot\Cups\Model\Job;
use Smalot\Cups\Transport\Client;
use Smalot\Cups\Transport\ResponseParser;
class ImprimirViaCups
{
	private $user;
	private $password;
	public function __construct()
	{
		$this->user='usuario sistema operativo';
		$this->password='password';
	}
	public function imprimir($archivo, $impresora)
	{
		$client = new Client($this->user, $this->password);
		$builder = new Builder();
		$responseParser = new ResponseParser();
		$printerManager = new PrinterManager($builder, $client, $responseParser);
		$printer = $printerManager->findByUri('ipp://localhost:631/printers/'.$impresora);
		$jobManager = new JobManager($builder, $client, $responseParser);
		$job = new Job();
		$job->setName('nombre jobs de impresión ');
		$job->setCopies('1');
		$job->setPageRanges('1');
		$job->addFile($archivo);
		$job->addAttribute('fit-to-page', true);
		return $jobManager->send($printer, $job);
	}
	public function listarTrabajosPorImpresora($impresora)
	{
		$client = new Client();
		$builder = new Builder();
		$responseParser = new ResponseParser();

		$printerManager = new PrinterManager($builder, $client, $responseParser);
		$printer = $printerManager->findByUri('ipp://localhost:631/printers/'.$impresora);

		$jobManager = new JobManager($builder, $client, $responseParser);
		$jobs = $jobManager->getList($printer, false, 0, 'completed');

		/*
		foreach ($jobs as $job) {
		    echo '#'.$job->getId().' '.$job->getName().' - '.$job->getState().'<hr />';
		}
		*/
		return $jobs;
	}
	public function listarImpresoras()
	{
		$printerManager = new PrinterManager(new Builder(), new Client(), new ResponseParser());
		$printers = $printerManager->getList();
		/*
		foreach ($printers as $printer) {
		    echo $printer->getName().' ('.$printer->getUri().')'."<hr />";
		}
		*/
		return $printers;
	}
}