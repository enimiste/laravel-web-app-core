<?php
/**
 * Created by PhpStorm.
 * User: elbachirnouni
 * Date: 04/03/2017
 * Time: 14:32
 */

use Enimiste\LaravelWebApp\Core\Contracts\File\FileWriterInterface;
use Illuminate\Contracts\Cache\Repository;
use Illuminate\Contracts\Filesystem\Filesystem;
use Intervention\Image\ImageCache;
use Intervention\Image\ImageManager;

if (!function_exists('array_nth')) {
    /**
     * Get the nth element from the array
     * @param array $arr
     * @param int $nth from 0
     *
     * @return mixed null if not found
     */
    function array_nth(array $arr, $nth)
    {
        $i = 0;
        foreach ($arr as $k => $v) {
            if ($i === $nth) return $v;
            $i++;
        }

        return null;
    }
}

if (!function_exists('image_encoded_as_string')) {
    /**
     * @param string $image path or url (any value accepted by \Intervention\Image\ImageManager::make
     * @param string $encoding
     * Supported values : data-url
     * @return string allow_url_fopen must be enabled to use url
     *
     * allow_url_fopen must be enabled to use url
     */
    function image_encoded_as_string($image, $encoding = 'data-url')
    {
        /** @var ImageManager $imageManager */
        $imageManager = app(ImageManager::class);

        return $imageManager->cache(function (ImageCache $imageCache) use ($image, $encoding) {
            $imageCache->make($image)
                ->encode($encoding);
        }, 60 * 24 * 7, false);
    }
}

if (!function_exists('move_from_fs_to_temp_file')) {
    /**
     * @param Filesystem $fs
     * @param string $fsPath
     * @return string temp file path
     */
    function move_from_fs_to_temp_file(Filesystem $fs, $fsPath)
    {
        /** @var Repository $cache */
        $cache = app(Repository::class);

        $tmpDir = sys_get_temp_dir();
        //$tmpFile = $tmpDir . DIRECTORY_SEPARATOR . random_int(1, 1000) . '_' . time() . '.' . basename($fsPath);

        $key = $tmpDir . DIRECTORY_SEPARATOR . sha1(serialize($fs) . $fsPath) . '_' . basename($fsPath);
        if (!file_exists($key)) {
            /** @var FileWriterInterface $fileWriter */
            $fileWriter = app(FileWriterInterface::class);
            $fileWriter->setContents($key, $fs->get($fsPath), false);
        }

        return $key;
    }
}

if (!function_exists('add_if_macosx')) {
    /**
     * @param array $config
     * @param string $key
     * @param string $value
     * @return array
     */
    function add_if_macosx(array $config, $key, $value)
    {
        if (env('IS_MAC_OSX')) {
            $config[$key] = $value;
        }
        return $config;
    }
}