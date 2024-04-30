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
  public function doSomething(): void {
    // @todo Place your code here.
  }

}
