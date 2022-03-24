<?php
namespace App\Controllers;

use App\Helpers\CommissionBot\{Callback, Text};
use Psr\Http\Message\ResponseInterface;
use skrtdev\NovaGram\Bot;
use Psr\Http\Message\ServerRequestInterface;
use skrtdev\Telegram\{Message, CallbackQuery};
use App\Core\Controller;

class BotTgController extends Controller
{   
    private Bot $bot;

    public function __construct(Bot $Bot)
    {
    $this->bot = $Bot;
    }

    public function bot(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        $Bot =  $this->bot; 
        $Bot->onCallbackQuery(function (CallbackQuery $callback_query) use ($Bot) {
            $call =  new Callback($callback_query,$Bot);
            $call->main();
        });
        $Bot->onTextMessage(function (Message $message) use ($Bot) {
            $text =  new Text($message, $Bot);
            $text->main();
        });
        $Bot->start();
        return $response;
    }
}
