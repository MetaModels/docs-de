.. _rst_cookbook_debug_profiling:

Profiling
===============

http://www.symfony-grenoble.fr/en/390/add-your-own-data-to-the-profiler-timeline-2/

z.B.
handler_backend_listeners.yml
    cca.dc-general.backend_listener.edit_handler:
        class: ContaoCommunityAlliance\DcGeneral\Contao\View\Contao2BackendView\ActionHandler\EditHandler
        public: true
        arguments:
            - "@cca.dc-general.scope-matcher"
            - "@?debug.stopwatch"
        tags:
            -   name: kernel.event_listener
                event: dc-general.action
                method: handleEvent

EditHandler.php

use Symfony\Component\Stopwatch\Stopwatch;

    /**
    * @var Stopwatch
    */
    protected $stopwatch;

    /**
     * EditHandler constructor.
     *
     * @param RequestScopeDeterminator $scopeDeterminator The request mode determinator.
     */
    public function __construct(RequestScopeDeterminator $scopeDeterminator, Stopwatch $stopwatch = null)
    {
        $this->setScopeDeterminator($scopeDeterminator);
        $this->stopwatch = $stopwatch;
    }

    protected function process(EnvironmentInterface $environment)
    {
    
        if ($this->stopwatch) {
            $this->stopwatch->start(__CLASS__ . '::process.model');
        }
        $model = $dataProvider->fetch($modelTemp);
        if ($this->stopwatch) {
            $this->stopwatch->stop(__CLASS__ . '::process.model');
        }

|img_profiling|

blackfire.io
============
php.ini anpassen

C:\ProgramData\blackfire
agent.ini

C:\Program Files\blackfire
blackfire-agent.exe starten



.. |img_profiling| image:: /_img/screenshots/cookbook/debug/profiling.jpg