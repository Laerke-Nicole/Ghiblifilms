<?php
// movie management
echo '<div id="movieSection" class="expanded-section" style="display: none;">';
    require 'crud/adminModules/movieAdmin.php';
echo '</div>';

echo '<div id="showingSection" class="expanded-section" style="display: none;">';
    require 'crud/adminModules/showingsAdmin.php'; 
echo '</div>';

echo '<div id="genreSection" class="expanded-section" style="display: none;">';
    require 'crud/adminModules/genreAdmin.php'; 
echo '</div>';

echo '<div id="movieGenreSection" class="expanded-section" style="display: none;">';
    require 'crud/adminModules/movieGenreAdmin.php'; 
echo '</div>';

echo '<div id="roleInProductionSection" class="expanded-section" style="display: none;">';
    require 'crud/adminModules/roleInProductionAdmin.php'; 
echo '</div>';

echo '<div id="productionSection" class="expanded-section" style="display: none;">';
    require 'crud/adminModules/ProductionAdmin.php'; 
echo '</div>';

echo '<div id="movieProductionSection" class="expanded-section" style="display: none;">';
    require 'crud/adminModules/movieProductionAdmin.php'; 
echo '</div>';

echo '<div id="voiceActorSection" class="expanded-section" style="display: none;">';
    require 'crud/adminModules/voiceActorAdmin.php'; 
echo '</div>';

echo '<div id="movieVoiceActorSection" class="expanded-section" style="display: none;">';
    require 'crud/adminModules/movieVoiceActorAdmin.php'; 
echo '</div>';

    
// company management
echo '<div id="companyInfoSection" class="expanded-section" style="display: none;">';
    require 'crud/adminModules/companyInformationAdmin.php'; 
echo '</div>';

echo '<div id="openingHourSection" class="expanded-section" style="display: none;">';
    require 'crud/adminModules/openingHourAdmin.php'; 
echo '</div>';

echo '<div id="newsSection" class="expanded-section" style="display: none;">';
    require 'crud/adminModules/newsAdmin.php'; 
echo '</div>';


// user management
echo '<div id="userSection" class="expanded-section ml-250" style="display: none;">';
    require 'crud/adminModules/userAdmin.php'; 
echo '</div>';

// address management
echo '<div id="postalCodeSection" class="expanded-section ml-250" style="display: none;">';
    require 'crud/adminModules/postalCodeAdmin.php'; 
echo '</div>';

// reservations management
echo '<div id="reservationSection" class="expanded-section ml-250" style="display: none;">';
    require 'crud/adminModules/reservationAdmin.php';
echo '</div>';