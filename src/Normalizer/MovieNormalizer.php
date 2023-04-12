<?php

namespace Drupal\challenge_movie_entity\Normalizer;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityTypeManagerInterface;
use Drupal\serialization\Normalizer\EntityNormalizer;

class MovieNormalizer extends EntityNormalizer {

    public function __construct(EntityTypeManagerInterface $entity_type_manager) {
        parent::__construct($entity_type_manager);
    }

    public function supportsNormalization($data, $format = NULL) {
        return $data instanceof MovieInterface;
    }


}

