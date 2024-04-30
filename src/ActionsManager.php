<?php

declare(strict_types=1);

namespace Drupal\devui;

use Drupal\Core\Entity\EntityTypeManagerInterface;
use Drupal\Core\Session\AccountProxyInterface;
use Psr\Http\Client\ClientInterface;

/**
 * @todo Add class description.
 */
final class ActionsManager
{

  /**
   * Constructs an ActionsManager object.
   */
  public function __construct(
    private readonly ClientInterface $httpClient,
    private readonly AccountProxyInterface $currentUser,
    private readonly EntityTypeManagerInterface $entityTypeManager,
  ) {
  }

  /**
   * Helper to get the path to drush from cthe config.
   */
  public function getPathToDrush(): string
  {
    return \Drupal::configFactory()->get('devui.settings')->get('path_to_drush');
  }

  /**
   * @todo Add method description.
   */
  public function runDrushCexOnHost()
  {
    $output = [];
    $return_var = 0;
    $path_to_drush = $this->getPathToDrush();
    $command = $path_to_drush . ' cex -y';

    // Execute the command and capture output and return status
    exec($command . ' 2>&1', $output, $return_var);

    // Convert the output array to a string
    $output_str = implode("\n", $output);

    // Log the output for debugging
    \Drupal::logger('devui')->info('Drush command output: ' . $output_str);

    if ($return_var === 0) {
      // If the command was successful
      return [
        'success' => true,
        'message' => 'Configuration export was successful.',
        'output' => $output_str,
      ];
    } else {
      // If the command failed
      \Drupal::logger('devui')->error('Error executing drush cex: ' . $output_str);
      return [
        'success' => false,
        'message' => 'Configuration export failed.',
        'output' => $output_str,
      ];
    }
  }
}
