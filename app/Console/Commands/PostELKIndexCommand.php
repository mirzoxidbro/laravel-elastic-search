<?php

namespace App\Console\Commands;

use App\Models\Post;
use Elastic\Elasticsearch\ClientBuilder;
use Elastic\Elasticsearch\Exception\ClientResponseException;
use Elastic\Elasticsearch\Exception\ServerResponseException;
use Exception;
use Illuminate\Console\Command;

class PostELKIndexCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:post-e-l-k-index';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $client = ClientBuilder::create()->build();

        try {
          $response = $client->index(Post::getIndexSettings());
        } catch (ClientResponseException $e) {
          // manage the 4xx error
        } catch (ServerResponseException $e) {
          // manage the 5xx error
        } catch (Exception $e) {
          // eg. network error like NoNodeAvailableException
        }
    }
}
