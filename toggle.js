// Toggle button on admin page
function toggleSection(sectionId) {
    // all id from admin.php
    const sections = ['movieAdmin', 'movieGenreAdmin', 'movieProductionAdmin', 'movieVoiceActorAdmin', 'userAdmin', 'newsAdmin', 'companyInformationAdmin', 'openingHourAdmin'];

    sections.forEach((section) => {
        const sectionDiv = document.getElementById(section);
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