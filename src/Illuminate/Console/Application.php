<?php namespace Illuminate\Console;

use Illuminate\Container;
use Symfony\Component\Console\Command\Command as SymfonyCommand;

class Application extends \Symfony\Component\Console\Application {

	/**
	 * The Laravel application instance.
	 *
	 * @var Illuminate\Foundation\Application
	 */
	protected $laravel;

	/**
	 * Start a new Console application.
	 *
	 * @param  Illuminate\Foundation\Application  $app
	 * @return Illuminate\Console\Application
	 */
	public static function start($app)
	{
		return require __DIR__.'/../../start.php';
	}

	/**
	 * Add a command to the console.
	 *
	 * @param  Symfony\Component\Console\Command\Command  $command
	 * @return Symfony\Component\Console\Command\Command
	 */
	public function add(SymfonyCommand $command)
	{
		if ($command instanceof Command)
		{
			$command->setLaravel($this->laravel);
		}

		parent::add($command);
	}

	/**
	 * Add a command, resolving through the container.
	 *
	 * @param  string  $command
	 * @return void
	 */
	public function resolve($command)
	{
		return $this->add($this->container->resolve($command));
	}

	/**
	 * Get the IoC container instance.
	 *
	 * @return Illuminate\Container
	 */
	public function getContainer()
	{
		return $this->container;
	}

	/**
	 * Set the IoC container instance.
	 *
	 * @param  Illuminate\Container  $container
	 * @return void
	 */
	public function setContainer(Container $container)
	{
		$this->container = $container;
	}

	/**
	 * Set the Laravel application instance.
	 *
	 * @param  Illuminate\Foundation\Application  $laravel
	 * @return void
	 */
	public function setLaravel($laravel)
	{
		$this->laravel = $laravel;
	}

}