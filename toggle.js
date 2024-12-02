function toggleSection(sectionId) {
    const sections = ['postalCodeAdmin', 'genreAdmin', 'roleInProductionAdmin', 'productionAdmin', 'voiceActorAdmin', 'movieAdmin', 'movieGenreAdmin', 'movieProductionAdmin', 'movieVoiceActorAdmin', 'showingsAdmin', 'premiereAdmin', 'userAdmin', 'newsAdmin', 'companyInformationAdmin', 'openingHourAdmin', 'reservationAdmin'];

    sections.forEach((section) => {
        const sectionDiv = document.getElementById(section);
        console.log(`Toggling section: ${section}`); 

        if (section === sectionId) {
            if (sectionDiv.style.display === 'block') {
                sectionDiv.style.display = 'none';
            } else {
                sectionDiv.style.display = 'block';
            }
        } else {
            sectionDiv.style.display = 'none';
        }
    });
}