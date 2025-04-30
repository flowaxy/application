<?php

namespace Application\Controllers\Cabinet;

use Application\Core\BaseController;

class RecoverController extends BaseController
{
    // A common method to render views for the recovery process
    private function renderRecoveryPage(string $viewName): void
    {
        // Generate content for the page
        $content = $this->view($viewName, [], true);
        // Send content to the layout template
        $this->view('cabinet/layouts/auth', ['content' => $content]);
    }

    public function request(): void
    {
        $this->renderRecoveryPage('cabinet/recover-request');
    }

    public function sent(): void
    {
        $this->renderRecoveryPage('cabinet/recover-sent');
    }

    public function reset(): void
    {
        $this->renderRecoveryPage('cabinet/recover-reset');
    }

    public function done(): void
    {
        $this->renderRecoveryPage('cabinet/recover-done');
    }
}
