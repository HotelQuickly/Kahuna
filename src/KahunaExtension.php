<?php
namespace HQ\Kahuna;
use Nette;
// compatibility for nette 2.0.x and 2.1.x
if (!class_exists('Nette\DI\CompilerExtension')) {
	class_alias('Nette\Config\CompilerExtension', 'Nette\DI\CompilerExtension');
}

/**
 * Class KahunaExtension
 *
 * @author Jakapun Kehachindawat <jakapun.kehachindawat@hotelquickly.com>
 */
class KahunaExtension extends Nette\DI\CompilerExtension
{
	public $defaults = array(
		'apiBaseUrl' => 'https://tap-nexus.appspot.com/api',
		'authUsername' => 'abc',
		'authPassword' => 'abc',
		'isSandbox' => true
	);

	public function loadConfiguration()
	{
		$config = $this->getConfig($this->defaults);
		$builder = $this->getContainerBuilder();

		// add service kahunaRequestFactory
		$builder->addDefinition('kahunaRequestFactory')
			->setClass('\HQ\Kahuna\RequestFactory', array($config));

		// add service kahunaManager
		$builder->addDefinition('kahunaManager')
			->setClass('\HQ\Kahuna\Manager', array('@kahunaRequestFactory'));
	}
}