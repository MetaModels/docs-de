<?php

namespace AppBundle\EventListener;

use ContaoCommunityAlliance\DcGeneral\Contao\RequestScopeDeterminator;
use ContaoCommunityAlliance\DcGeneral\Event\PrePersistModelEvent;
use Contao\Controller;
use Contao\CoreBundle\Framework\ContaoFramework;
use Contao\CoreBundle\InsertTag\InsertTagParser;
use Contao\CoreBundle\Monolog\ContaoContext;
use Contao\CoreBundle\Routing\ContentUrlGenerator;
use Contao\CoreBundle\Routing\ScopeMatcher;
use Contao\CoreBundle\String\SimpleTokenParser;
use Contao\FrontendUser;
use Contao\MemberModel;
use Contao\PageModel;
use Doctrine\DBAL\Connection;
use MetaModels\Filter\Setting\FilterSettingFactory;
use MetaModels\IFactory;
use MetaModels\IMetaModel;
use MetaModels\Render\Setting\RenderSettingFactory;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Terminal42\NotificationCenterBundle\NotificationCenter;

final readonly class MetaModelsServiceExamplesListener
{
    public function __construct(
        private IFactory                 $factory,
        private FilterSettingFactory     $filterFactory,
        private RenderSettingFactory     $renderFactory,
        private Connection               $connection,
        private LoggerInterface          $logger,
        private MailerInterface          $mailer,
        private NotificationCenter       $notificationCenter,
        private RequestStack             $requestStack,
        private Security                 $security,
        private TokenStorageInterface    $tokenStorage,
        private ContaoFramework          $framework,
        private ScopeMatcher             $scopeMatcher,
        private RequestScopeDeterminator $scopeDeterminator,
        private ContentUrlGenerator      $urlGenerator,
        private HttpClientInterface      $httpClient,
        private SimpleTokenParser        $tokenParser,
        private InsertTagParser          $inserttagParser,
        private string                   $rootPath
    ) {
    }

    public function onMetaModelsServiceExamples(PrePersistModelEvent $event): void
    {
        // MetaModels.
        $modelName = 'mm_my_model';
        $filterId = 11;
        $renderId = 22;
        $model    = $this->factory->getMetaModel($modelName);
        assert($model instanceof IMetaModel);
        $filter = $model->getEmptyFilter();
        $filterCollection = $this->filterFactory->createCollection($filterId);
        $filterCollection->addRules($filter, []);
        $items = $model->findByFilter($filter);

        if (!$items->getCount()) {
            return;
        }

        $currentItem = $items
            ->getItem()
            ->parseValue('html5', $this->renderFactory->createCollection($model, $renderId));

        // Database.
        $isPublished = 1;
        $modelData = $this->connection->createQueryBuilder()
            ->select('t.*')
            ->from('mm_my_model', 't')
            ->where('published=:published')
            ->setParameter('published', $isPublished)
            ->executeQuery()
            ->fetchAllAssociative();

        // Logger.
        $message = 'This is a message.';
        $e       = new \Exception('This is an exception.');
        $this->logger->error($message, [
            'contao' => new ContaoContext(__METHOD__, ContaoContext::ERROR),
            'exception' => $e,
        ]);

        // Mailer.
        // Symfony.
        $message = (new Email())
            ->from('webmaster@domain.de')
            ->to('admin@domain.de')
            ->replyTo('webmaster@domain.de')
            ->subject('My subject')
            ->text('My body');
        $this->mailer->send($message);

        // NotificationCenter.
        $messageId = 42;
        $tokens    = [
            'recipient_email' => 'admin@domain.de',
            'form_name'       => 'Blaubär',
            'form_message'    => 'My body',
            'form_email'      => 'blaubaer@home.de',
        ];
        $this->notificationCenter->sendNotification($messageId, $tokens);

        // RequestStack.
        $token = $this->requestStack->getCurrentRequest()->query->get('token');

        // Session.
        $request = $this->requestStack->getCurrentRequest();
        if (!$request) {
            throw new \Exception('Session or request not found!');
        }
        $sessionData         = $request->getSession()->get('MM-DATA', []);
        $sessionData['moin'] = 'my data';
        $request->getSession()->set('MM-DATA', $sessionData);      // Set session data.
        $sessionData = $request->getSession()->get('MM-DATA', []); // Get session data.

        // Security - Further explanation can be found in the text following the example.
        // Empfohlen: security.helper - kann Rechte pruefen UND den User holen.
        if (!$this->security->isGranted('ROLE_MEMBER')) {
            return;
        }
        if (!($user = $this->security->getUser()) instanceof FrontendUser) {
            return;
        }
        // Contao-MemberModel (mit allen DB-Feldern) per Username nachladen.
        $member = MemberModel::findByUsername($user->getUserIdentifier());

        // Alternative 1: Contao-Framework (Legacy). getInstance() liefert den aktuellen
        // Frontend-User als Contao-Objekt inkl. DB-Feldern - createInstance() waere eine
        // neue, leere Instanz und damit falsch.
        $member = $this->framework->getAdapter(FrontendUser::class)->getInstance();

        // Alternative 2: security.token_storage (Low-Level, kein Rechte-Check).
        $token = $this->tokenStorage->getToken();
        if (null === $token || !($user = $token->getUser()) instanceof FrontendUser) {
            return;
        }
        $userGroups = $user->groups;

        // Scope.
        // Contao.
        $currentRequest = $this->requestStack->getCurrentRequest();
        $isFrontend     = $this->scopeMatcher->isFrontend($currentRequest);
        $isBackend      = $this->scopeMatcher->isBackend($currentRequest);

        // DC_General.
        $isFrontend = $this->scopeDeterminator->isFrontend();
        $isBackend  = $this->scopeDeterminator->isBackend();

        // URL.
        if (null === ($page = PageModel::findByPk(42))) {
            return;
        }
        $url = $this->urlGenerator->generate($page);
        Controller::redirect($url);

        // HTTP Client.
        $httpClient = $this->httpClient;
        $url        = 'https://api.domain.de/v1/my-endpoint';
        $options    = ['query' => ['foo' => 'bar']];
        $response   = $httpClient->request('GET', $url, $options);
        if (200 !== $response->getStatusCode()) {
            return;
        }
        $data = $response->toArray();

        // Parser.
        // Token.
        $subject = 'Hello ##firstname## ##lastname##!';
        $tokens  = ['firstname' => 'John', 'lastname' => 'Doe'];
        $message = $this->tokenParser->parse($subject, $tokens);

        // Inserttag.
        $content = '<a href="{{link_url::4711}}">read more</a>';
        $content = $this->inserttagParser->parse($content);

        // Root path.
        $filePath = 'files/my_folder/moinmoin.pdf';
        if (\file_exists($this->rootPath . '/' . $filePath)) {
            $file = $this->rootPath . '/' . $filePath;
        }
    }
}
