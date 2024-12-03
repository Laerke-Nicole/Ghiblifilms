// showing the categories categories like movie, genre, actor etc
function showCategory(category) {
    // hide all sections
    document.querySelectorAll('.category-section').forEach(section => {
        section.style.display = 'none';
    });

    // show the selected section
    const section = document.getElementById(`${category}-section`);
    if (section) {
        section.style.display = 'block';
    }

    // scroll to the top of the page when clicking another category in submenu
    window.scrollTo({
        top: 0,
        behavior: 'smooth'
    });
}

// make the expanded section aka the add and added visible and scroll to it
function expandSection(sectionId) {
    // hide all expanded sections
    document.querySelectorAll('.expanded-section').forEach(section => {
        section.style.display = 'none'; 
    });

    // show the selected expanded section and scroll to it
    const section = document.getElementById(sectionId);
    if (section) {
        section.style.display = 'block';
        section.scrollIntoView({ behavior: 'smooth' });
    }
}