<?php

declare(strict_types=1);

namespace Drupal\devui;

use Drupal\Core\Entity\EntityTypeManagerInterface;
use Drupal\Core\Session\AccountProxyInterface;
use Psr\Http\Client\ClientInterface;

/**
 * @todo Add class description.
 */
final class ActionsManager {

  /**
   * Constructs an ActionsManager object.
   */
  public function __construct(
    private readonly ClientInterface $httpClient,
    private readonly AccountProxyInterface $currentUser,
    private readonly EntityTypeManagerInterface $entityTypeManager,
  ) {}

  /**
   * @todo Add method description.
   */
  public function runDrushCexOnHost(): bool {
    try {
    // Execute a `fin drush cex -y` in the local shell.
    $command = 'fin drush cex -y';
    shell_exec($command);
    return TRUE;
    } catch (\Exception $e) {
      return FALSE;
    }

  }

}
