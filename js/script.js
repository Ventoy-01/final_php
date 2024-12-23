// Total Orders Chart
const totalOrdersChart = new Chart(document.getElementById('totalOrdersChart'), {
    type: 'doughnut',
    data: {
      labels: ['Completed', 'Pending', 'Cancelled'],
      datasets: [
        {
          label: 'Orders',
          data: [75, 20, 5], // Vos données ici
          backgroundColor: ['#4caf50', '#ff9800', '#f44336'],
        },
      ],
    },
    options: {
      responsive: true,
      plugins: {
        legend: {
          display: true,
          position: 'bottom',
        },
      },
    },
  });
  
  // Customer Growth Chart
  const customerGrowthChart = new Chart(document.getElementById('customerGrowthChart'), {
    type: 'pie',
    data: {
      labels: ['New Customers', 'Returning Customers'],
      datasets: [
        {
          label: 'Growth',
          data: [60, 40], // Vos données ici
          backgroundColor: ['#2196f3', '#9c27b0'],
        },
      ],
    },
    options: {
      responsive: true,
      plugins: {
        legend: {
          display: true,
          position: 'bottom',
        },
      },
    },
  });
  
  // Total Revenue Chart
  const totalRevenueChart = new Chart(document.getElementById('totalRevenueChart'), {
    type: 'doughnut',
    data: {
      labels: ['Online', 'Offline'],
      datasets: [
        {
          label: 'Revenue',
          data: [70, 30], // Vos données ici
          backgroundColor: ['#3f51b5', '#00bcd4'],
        },
      ],
    },
    options: {
      responsive: true,
      plugins: {
        legend: {
          display: true,
          position: 'bottom',
        },
      },
    },
  });
  
   // Get the modal
   var modal = document.getElementById("myModal");

   // Get the button that opens the modal
   var btn = document.getElementById("myBtn");

   // Get the <span> element that closes the modal
   var span = document.getElementsByClassName("close")[0];

   // When the user clicks the button, open the modal
   btn.onclick = function() {
       modal.style.display = "block";
   };

   // When the user clicks on <span> (x), close the modal
   span.onclick = function() {
       modal.style.display = "none";
   };

   // When the user clicks anywhere outside of the modal, close it
   window.onclick = function(event) {
       if (event.target == modal) {
           modal.style.display = "none";
       }
   };
    // ajoutmodal
      // Get the modal




  // Obtenir les éléments
const openModalBtn = document.getElementById('openModalBtn');
const closeModalBtn = document.getElementById('closeModalBtn');
const formModal = document.getElementById('formModal');

// Ouvrir le modal
openModalBtn.addEventListener('click', () => {
    formModal.classList.remove('d-none');
});

// Fermer le modal
closeModalBtn.addEventListener('click', () => {
    formModal.classList.add('d-none');
});

// Fermer le modal lorsqu'on clique en dehors du contenu
formModal.addEventListener('click', (e) => {
    if (e.target === formModal) {
        formModal.classList.add('d-none');
    }
});

