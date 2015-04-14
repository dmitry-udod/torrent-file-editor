<?php namespace App\Http\Controllers;

use App\Generators\SiteMapGenerator;

class WelcomeController extends Controller {

	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
		$files = \File::allFiles(app_path() . '/../public' . SiteMapGenerator::SITE_MAPS_DIRECTORY);

		return view('welcome', compact('files'));
	}

}
