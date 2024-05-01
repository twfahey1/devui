<?php

declare(strict_types=1);

namespace Drupal\devui\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Ajax\AjaxResponse;
use Drupal\Core\Ajax\HtmlCommand;

/**
 * Provides a DevUI form.
 */
final class ToolsForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId(): string {
    return 'devui_tools';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state): array {
    $form['export_config'] = [
      '#type' => 'button',
      '#value' => $this->t('Export Config'),
      '#ajax' => [
        'callback' => '::exportConfigCallback',
        'wrapper' => 'export-config-status',
      ],
    ];

    $form['export_config_status'] = [
      '#type' => 'markup',
      '#markup' => '<div id="export-config-status"></div>',
    ];

    return $form;
  }

  /**
   * Ajax callback for exporting configuration.
   */
  public function exportConfigCallback(array &$form, FormStateInterface $form_state): AjaxResponse {
    $response = new AjaxResponse();
    $result = $this->actionsManager()->runDrushCexOnHost();

    if ($result) {
      $message = $this->t('Configuration export was successful.');
    } else {
      $message = $this->t('Configuration export failed.');
    }

    $response->addCommand(new HtmlCommand('#export-config-status', $message));
    return $response;
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state): void {
    // Validation logic as needed.
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state): void {
    $this->messenger()->addStatus($this->t('The message has been sent.'));
    $form_state->setRedirect('<front>');
  }

  /**
   * Get the actions manager service.
   */
  private function actionsManager() {
    return \Drupal::service('devui.actions_manager');
  }

}
