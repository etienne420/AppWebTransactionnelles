<?php

declare(strict_types=1);

require_once __DIR__ . '/../Vues/Vue.php';

class ControleurAccueil
{
	private Vue $vue;

	public function __construct(Vue $vue)
	{
		$this->vue = $vue;
	}

	public function index(): void
	{
		$this->vue->afficher(__DIR__ . '/../Vues/accueil.php');
	}
}