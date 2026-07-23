function toggleDropdown() {
            let dropdown = document.getElementById("dropdownMenu");
            dropdown.classList.toggle("show");
        }

        //close menu when click
        document.addEventListener('click', function(event) {
            let dropdown = document.getElementById("dropdownMenu");
            let hamburger = document.getElementById('hamburgerMenu');
            if (!hamburger.contains(event.target) && !dropdown.contains(event.target)) {
                dropdown.classList.remove('show');
            }
        });