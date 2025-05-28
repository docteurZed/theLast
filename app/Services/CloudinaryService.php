<?php
namespace App\Services;

use Exception;

class CloudinaryService
{
    protected string $cloudName;
    protected string $apiKey;
    protected string $apiSecret;
    protected string $uploadUrl;

    public function __construct()
    {
        $this->cloudName = config('cloudinary.cloud');       // 'cloud'
        $this->apiKey = config('cloudinary.key');             // 'key'
        $this->apiSecret = config('cloudinary.secret');       // 'secret'
        $this->uploadUrl = "https://api.cloudinary.com/v1_1/{$this->cloudName}/image/upload";
    }


    /**
     * Génère la signature Cloudinary pour upload signé
     * @param array $params
     * @return string
     */
    protected function generateSignature(array $params): string
    {
        ksort($params);

        $paramString = http_build_query($params, '', '&', PHP_QUERY_RFC3986);
        $paramString = urldecode($paramString);

        return sha1($paramString . $this->apiSecret);
    }

    /**
     * Upload un fichier local vers Cloudinary avec signature
     *
     * @param string $filePath Chemin absolu du fichier local
     * @param array $options Options upload Cloudinary (ex: folder, public_id)
     * @return array Réponse décodée JSON Cloudinary
     * @throws Exception
     */
    public function upload(string $filePath, array $options = []): array
    {
        if (!file_exists($filePath)) {
            throw new Exception("Fichier non trouvé : {$filePath}");
        }

        $timestamp = time();

        $params = array_merge([
            'timestamp' => $timestamp,
        ], $options);

        $signature = $this->generateSignature($params);

        $postData = [
            'file' => new \CURLFile($filePath),
            'api_key' => $this->apiKey,
            'timestamp' => $timestamp,
            'signature' => $signature,
        ];

        // Ajouter options dans postData
        foreach ($options as $key => $value) {
            $postData[$key] = $value;
        }

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->uploadUrl);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // ⚠️ Temporaire
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false); // ⚠️ Temporaire


        $response = curl_exec($ch);

        if ($response === false) {
            throw new Exception('Erreur cURL: ' . curl_error($ch));
        }

        curl_close($ch);

        $result = json_decode($response, true);

        if (isset($result['error'])) {
            throw new Exception('Cloudinary error: ' . $result['error']['message']);
        }

        return $result;
    }

    /**
     * Supprime une ressource sur Cloudinary à partir de son public_id
     *
     * @param string $publicId
     * @return bool
     * @throws Exception
     */
    public function delete(string $publicId): bool
    {
        $timestamp = time();

        $paramsToSign = [
            'public_id' => $publicId,
            'timestamp' => $timestamp,
        ];

        $signature = $this->generateSignature($paramsToSign);

        $postData = [
            'public_id' => $publicId,
            'api_key' => $this->apiKey,
            'timestamp' => $timestamp,
            'signature' => $signature,
        ];

        $deleteUrl = "https://api.cloudinary.com/v1_1/{$this->cloudName}/image/destroy";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $deleteUrl);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // ⚠️ À désactiver uniquement en local
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

        $response = curl_exec($ch);

        if ($response === false) {
            throw new Exception('Erreur cURL: ' . curl_error($ch));
        }

        curl_close($ch);

        $result = json_decode($response, true);

        if (isset($result['error'])) {
            throw new Exception('Cloudinary error: ' . $result['error']['message']);
        }

        return $result['result'] === 'ok';
    }

    public function extractPublicId(string $url): string
    {
        $part = explode('/upload/', $url)[1] ?? '';
        $part = preg_replace('/^v\d+\//', '', $part);
        return pathinfo($part, PATHINFO_FILENAME);
    }
}
