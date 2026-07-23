// Get modal element
        var modal = document.getElementById('bookingModal');
        
        // Function to open booking modal
        function OpenModal(doctorName, doctorSpecialty, doctorId) {
            // Set doctor information in hidden fields
            document.getElementById('modalDoctorName').value = doctorName;
            document.getElementById('modalDoctorSpecialty').value = doctorSpecialty;
            document.getElementById('modalDoctorId').value = doctorId;
            
            // Display doctor info in readonly field
            document.getElementById('doctorInfo').value = doctorName + ' - ' + doctorSpecialty;
            
            // Set minimum date to today
            var today = new Date().toISOString().split('T')[0];
            document.getElementById('appointment_date').min = today;
            
            // Show modal
            modal.style.display = 'block';
        }
        
        // Function to close booking modal
        function closeBookingModal() {
            modal.style.display = 'none';
            // Reset form
            document.querySelector('#bookingModal form').reset();
        }
        
        // Close modal when clicking outside
        window.onclick = function(event) {
            if (event.target == modal) {
                closeBookingModal();
            }
        };
        
        // Set default date to tomorrow
        window.onload = function() {
            var tomorrow = new Date();
            tomorrow.setDate(tomorrow.getDate() + 1);
            var tomorrowStr = tomorrow.toISOString().split('T')[0];
            document.getElementById('appointment_date').value = tomorrowStr;
        };