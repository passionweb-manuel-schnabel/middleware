<?php


namespace Passionweb\Middleware\Middleware;


use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use TYPO3\CMS\Core\Context\Context;
use TYPO3\CMS\Core\Http\RedirectResponse;
use TYPO3\CMS\Core\Utility\GeneralUtility;

class AuthMiddleware implements MiddlewareInterface
{
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $context = GeneralUtility::makeInstance(Context::class);

        $isLoggedIn = $context->getPropertyFromAspect('frontend.user', 'isLoggedIn');
        $currentPath = $request->getUri()->getPath();

        if($isLoggedIn === false && $currentPath !== '/') {
            return new RedirectResponse('/', 302, []);
        }
        else {
            return $handler->handle($request);
        }
    }
}
