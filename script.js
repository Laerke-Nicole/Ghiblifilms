function toggleSection(sectionId) {
    // Array of all section IDs
    const sections = ['movieAdmin', 'userAdmin', 'newsAdmin'];

    // Loop through all sections
    sections.forEach((section) => {
        const sectionDiv = document.getElementById(section);
        if (section === sectionId) {
            // Toggle the clicked section
            sectionDiv.style.display = sectionDiv.style.display === 'none' || sectionDiv.style.display === '' ? 'block' : 'none';
        } else {
            // Hide other sections
            sectionDiv.style.display = 'none';
        }
    });
}
