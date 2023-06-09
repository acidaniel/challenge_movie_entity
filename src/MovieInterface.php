<?php

namespace Drupal\challenge_movie_entity;

use Drupal\Core\Entity\ContentEntityInterface;

/**
 * Provides an interface defining a movie entity type.
 */
interface MovieInterface extends ContentEntityInterface {

  /**
   * Gets the movie title.
   *
   * @return string
   *   Title of the movie.
   */
  public function getTitle();

  /**
   * Sets the movie title.
   *
   * @param string $title
   *   The movie title.
   *
   * @return \Drupal\challenge_movie_entity\MovieInterface
   *   The called movie entity.
   */
  public function setTitle($title);

  /**
   * Returns the movie status.
   *
   * @return bool
   *   TRUE if the movie is enabled, FALSE otherwise.
   */
  public function isEnabled();

  /**
   * Sets the movie status.
   *
   * @param bool $status
   *   TRUE to enable this movie, FALSE to disable.
   *
   * @return \Drupal\challenge_movie_entity\MovieInterface
   *   The called movie entity.
   */
  public function setStatus($status);

}
