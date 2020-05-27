<?php


if (! function_exists('version')) {
    /**
     * Set the version to generate API URLs to.
     *
     * @param string $version
     *
     * @return \Dingo\Api\Routing\UrlGenerator
     */
    function version($source)
    {
        //return app('api.url')->version($version);

		$version = 'release_v1.1.7.2018091218';
		return '/'.$source . '?v=' . $version;
    }
}
