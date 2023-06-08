// // Fetch the JSON data from the server
// fetch('../json/category.json')
// .then(response => response.json())
// .then(data => {
//     // Get the select element
//     const selectElement = document.getElementById('categorie');

//     // Iterate over each category and create an option element
//     data.forEach(category => {
//         const option = document.createElement('option');
//         option.value = category.category;
//         option.textContent = category.category;
//         selectElement.appendChild(option);
//     });

// })
// .catch(error => {
//     // Handle any errors that occurred during fetching or parsing the JSON data
//     const errorMessage = document.getElementById('error-message');
//     errorMessage.textContent = 'Failed to fetch or parse JSON data.';
// });

// Define a variable to store the fetched data
let categoriesData = null;

// Function to populate the categories select element
function populateCategoriesSelect(selectedCategory) {
  // Get the select element
  const selectElement = document.getElementById('categorie');

  // Iterate over each category in the fetched data and create an option element
  categoriesData.forEach(category => {
    const option = document.createElement('option');
    option.value = category.category;
    option.textContent = category.category;
    
    // Check if the current option matches the selected category
    if (category.category === selectedCategory) {
      option.selected = true; // Set the selected attribute
    }
    
    selectElement.appendChild(option);
  });
}

// Fetch the JSON data from the server only if it hasn't been fetched before
if (!categoriesData) {
  fetch('../json/category.json')
    .then(response => response.json())
    .then(data => {
      categoriesData = data; // Store the fetched data in the variable
      
      // Get the selected category from PHP
      const selectedCategory = "<?php echo $categorieOld; ?>";
      
      populateCategoriesSelect(selectedCategory); // Call the function to populate the select element with the selected category
    })
    .catch(error => {
      // Handle any errors that occurred during fetching or parsing the JSON data
      const errorMessage = document.getElementById('error-message');
      errorMessage.textContent = 'Failed to fetch or parse JSON data.';
    });
} else {
  // If the data has already been fetched, simply populate the select element
  // Get the selected category from PHP
  const selectedCategory = "<?php echo $categorieOld; ?>";
  
  populateCategoriesSelect(selectedCategory);
}


