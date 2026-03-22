const recipes = [
  {
    id: 1,
    title: "Classic Ribeye Steak",
    category: "high-protein",
    img: "https://images.unsplash.com/photo-1600891964092-4316c288032e?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80",
    description: "A perfectly seared ribeye steak bursting with flavor and packed with protein.",
    time: "20 Mins",
    ingredients: [
      "1 large Ribeye Steak (1.5 inches thick)",
      "2 tbsp Olive oil",
      "Salt and generously cracked black pepper",
      "3 cloves Garlic, crushed",
      "2 sprigs Fresh Rosemary",
      "2 tbsp Butter"
    ],
    instructions: [
      "Let the steak reach room temperature for 30 minutes before cooking.",
      "Pat the steak dry with paper towels. Rub with olive oil and generously season with salt and pepper.",
      "Heat a cast-iron skillet over high heat until smoking hot.",
      "Sear the steak for 4 minutes on one side until a crust forms.",
      "Flip the steak, add butter, garlic, and rosemary to the pan.",
      "Baste the steak with the melting butter for 3-4 minutes (for medium-rare).",
      "Remove from heat and let rest for 5-10 minutes before slicing."
    ]
  },
  {
    id: 2,
    title: "BBQ Pulled Pork",
    category: "bbq",
    img: "https://images.unsplash.com/photo-1529193591184-b1d58069ecdd?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80",
    description: "Slow-cooked, tender pulled pork smothered in rich BBQ sauce.",
    time: "4 Hours",
    ingredients: [
      "4 lbs Pork Shoulder",
      "1/4 cup Brown Sugar",
      "2 tbsp Smoked Paprika",
      "1 tbsp Garlic Powder",
      "1 tbsp Onion Powder",
      "2 cups BBQ Sauce",
      "1/2 cup Apple Cider Vinegar",
      "1/2 cup Chicken Broth"
    ],
    instructions: [
      "Mix brown sugar, paprika, garlic powder, onion powder, salt, and pepper to create a rub.",
      "Massage the rub thoroughly all over the pork shoulder.",
      "Place the pork in a slow cooker. Pour in apple cider vinegar and chicken broth.",
      "Cook on LOW for 8 hours or HIGH for 4-5 hours until pork is very tender.",
      "Remove pork, shred it using two forks.",
      "Return the shredded pork to the slow cooker, stir in BBQ sauce, and cook for another 15 minutes."
    ]
  },
  {
    id: 3,
    title: "Quick Chicken Stir-Fry",
    category: "quick",
    img: "https://images.unsplash.com/photo-1604908176997-125f25cc6f3d?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80",
    description: "A fast, high-protein meal loaded with fresh veggies and lean chicken breast.",
    time: "15 Mins",
    ingredients: [
      "2 Boneless skinless chicken breasts, sliced",
      "2 cups Mixed vegetables (broccoli, bell peppers, carrots)",
      "3 tbsp Soy sauce",
      "1 tbsp Sesame oil",
      "2 cloves Garlic, minced",
      "1 tbsp Ginger, grated",
      "1 tbsp Honey"
    ],
    instructions: [
      "In a small bowl, whisk together soy sauce, sesame oil, garlic, ginger, and honey.",
      "Heat a tablespoon of oil in a large skillet or wok over medium-high heat.",
      "Add chicken slices and cook until browned and cooked through (about 5-7 minutes). Remove chicken from pan.",
      "In the same pan, add vegetables and stir-fry for 3-4 minutes until tender-crisp.",
      "Add the chicken back into the pan, pour the sauce over the top, and toss everything together.",
      "Cook for another 2 minutes until the sauce thickens slightly. Serve warm."
    ]
  },
  {
    id: 4,
    title: "Smoked Brisket",
    category: "bbq",
    img: "https://images.unsplash.com/photo-1555939594-58d7cb561ad1?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80",
    description: "The ultimate low and slow smoked brisket for serious BBQ enthusiasts.",
    time: "12 Hours",
    ingredients: [
      "1 Whole packer brisket (10-12 lbs)",
      "1/2 cup Coarse black pepper",
      "1/2 cup Kosher salt",
      "1/4 cup Garlic powder",
      "Apple juice (for spritzing)"
    ],
    instructions: [
      "Trim the fat cap on the brisket leaving about 1/4 inch of fat, and remove the silver skin.",
      "Mix pepper, salt, and garlic powder. Apply generously across the entire brisket.",
      "Preheat your smoker to 250°F using oak or hickory wood.",
      "Place brisket in the smoker, fat side up. Smoke undisturbed for 4 hours.",
      "Spritz with apple juice every 45 minutes until the internal temperature reaches 165°F and a deep bark forms.",
      "Wrap the brisket tightly in butcher paper and return to the smoker.",
      "Continue smoking until the internal temperature reaches 203°F.",
      "Remove, wrap in a towel, and let it rest in a cooler for at least 2 hours before slicing against the grain."
    ]
  },
  {
    id: 5,
    title: "Protein Power Bowl",
    category: "high-protein",
    img: "https://images.unsplash.com/photo-1546069901-ba9599a7e63c?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80",
    description: "Quinoa, eggs, avocado, and spinach to fuel your body fast.",
    time: "10 Mins",
    ingredients: [
      "1 cup Cooked quinoa",
      "2 Hard-boiled eggs, sliced",
      "1/2 Avocado, sliced",
      "1 cup Fresh spinach",
      "1/4 cup Black beans",
      "Lemon juice, salt, and pepper",
      "Sriracha (optional)"
    ],
    instructions: [
      "Place cooked quinoa at the base of your bowl.",
      "Arrange the spinach, black beans, avocado, and eggs on top.",
      "Squeeze fresh lemon juice over the bowl.",
      "Season with a pinch of salt and cracked black pepper.",
      "Drizzle with Sriracha if you want some extra heat, and enjoy immediately."
    ]
  },
  {
    id: 6,
    title: "10-Minute Breakfast Burrito",
    category: "quick",
    img: "https://images.unsplash.com/photo-1626700051175-6818013e1d4f?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80",
    description: "Start your day like a beast with this quick and massive breakfast burrito.",
    time: "10 Mins",
    ingredients: [
      "2 Large flour tortillas",
      "4 Eggs",
      "1/2 cup Cheddar cheese, shredded",
      "4 slices Bacon, cooked and chopped",
      "1/4 cup Salsa",
      "1 tbsp Butter"
    ],
    instructions: [
      "Whisk the eggs in a bowl with a little salt and pepper.",
      "Heat butter in a non-stick skillet over medium-low heat. Pour in the eggs and scramble gently.",
      "Warm the tortillas in the microwave for 15 seconds.",
      "Lay out tortillas and divide the scrambled eggs, bacon, and cheese between them.",
      "Top with salsa, fold the sides in, and roll up tightly.",
      "Optional: Toast the burritos in a dry skillet for 1 minute per side to seal them."
    ]
  },
  {
    id: 7,
    title: "Grilled Salmon & Asparagus",
    category: "high-protein",
    img: "https://images.unsplash.com/photo-1467003909585-2f8a72700288?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80",
    description: "A lean and incredibly flavorful salmon dish that's ready in minutes.",
    time: "15 Mins",
    ingredients: [
      "2 Salmon fillets (6 oz each)",
      "1 bunch Asparagus, trimmed",
      "2 tbsp Olive oil",
      "1/2 Lemon, juiced",
      "Salt and pepper",
      "1 tsp Dill (optional)"
    ],
    instructions: [
      "Preheat grill or grill pan to medium-high heat.",
      "Toss the asparagus with 1 tbsp olive oil, salt, and pepper.",
      "Rub salmon fillets with remaining olive oil, lemon juice, salt, and pepper.",
      "Grill the salmon skin-side down for about 4 minutes until crispy.",
      "Flip the salmon and add asparagus to the grill. Cook for another 3-4 minutes.",
      "Remove from grill, garnish with dill and an extra squeeze of lemon, and serve."
    ]
  },
  {
    id: 8,
    title: "Loaded Sweet Potato",
    category: "quick",
    img: "https://images.unsplash.com/photo-1585834925700-111fb3184cd7?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80",
    description: "A microwaved sweet potato stuffed with ground turkey and veggies.",
    time: "12 Mins",
    ingredients: [
      "1 Large sweet potato",
      "1/2 cup Cooked ground turkey or beef",
      "1/4 cup Black beans",
      "1/4 cup Corn",
      "2 tbsp plain Greek yogurt (sour cream substitute)",
      "Salt and pepper",
      "Chives for garnish"
    ],
    instructions: [
      "Wash the sweet potato and poke several holes in it with a fork.",
      "Microwave on high for 6-8 minutes, turning halfway, until tender.",
      "Slice the sweet potato open down the middle.",
      "Warm the ground turkey, beans, and corn in a small pan or microwave.",
      "Stuff the sweet potato with the meat mixture.",
      "Top with a dollop of Greek yogurt, salt, pepper, and fresh chives."
    ]
  }
];

// Elements
const recipeContainer = document.getElementById('recipeContainer');
const searchInput = document.getElementById('searchInput');
const filterBtns = document.querySelectorAll('.filter-btn');
const noResults = document.getElementById('noResults');

// Display Recipes Function
function displayRecipes(recipeArray) {
  if (!recipeContainer) return; // Only run on recipes page
  
  recipeContainer.innerHTML = '';
  
  if (recipeArray.length === 0) {
    if(noResults) noResults.classList.remove('d-none');
    return;
  } else {
    if(noResults) noResults.classList.add('d-none');
  }

  recipeArray.forEach((recipe, index) => {
    // Add staggered animation delay based on index
    const delay = index * 0.1;
    const cardHTML = `
      <div class="col-sm-6 col-md-4 col-lg-3">
        <div class="recipe-card p-3 d-flex flex-column" style="animation-delay: ${delay}s; background-color: #1a1a1a; border: 1px solid #333; border-radius: 8px;">
          <div class="mb-3 d-flex align-items-center justify-content-center overflow-hidden" style="height: 180px; background-color: #e0e0e0; border-radius: 4px;">
             <!-- In the image it's a placeholder, but we will show the actual food image -->
             <img src="${recipe.img}" alt="${recipe.title}" class="img-fluid w-100 h-100" style="object-fit: cover;">
          </div>
          <div class="text-center mt-auto">
            <h5 class="text-white mb-3" style="font-size: 0.95rem; font-family: 'Inter', sans-serif; min-height: 45px;">${recipe.title}</h5>
            <button class="btn w-100 view-recipe-btn text-dark fw-bold py-2" data-id="${recipe.id}" data-bs-toggle="modal" data-bs-target="#recipeModal" style="background-color: #ffc107; border: none; border-radius: 4px; font-size: 0.9rem;">
              &#9733; View Recipe
            </button>
          </div>
        </div>
      </div>
    `;
    recipeContainer.insertAdjacentHTML('beforeend', cardHTML);
  });

  // Attach event listeners to newly created "View Recipe" buttons
  const viewBtns = document.querySelectorAll('.view-recipe-btn');
  viewBtns.forEach(btn => {
    btn.addEventListener('click', (e) => {
      // Must use currentTarget to ensure we get the button's data-id, even if an inner element is clicked
      const recipeId = parseInt(e.currentTarget.getAttribute('data-id'));
      openModal(recipeId);
    });
  });
}

// Open Modal Logic
function openModal(id) {
  const recipe = recipes.find(r => r.id === id);
  if (!recipe) return;

  // Populate modal data
  const titleEl = document.getElementById('recipeModalLabel');
  const imgEl = document.getElementById('modalRecipeImg');
  const categoryEl = document.getElementById('modalRecipeCategory');
  const timeEl = document.getElementById('modalRecipeTime');
  const descEl = document.getElementById('modalRecipeDescription');
  
  if(titleEl) titleEl.innerText = recipe.title;
  if(imgEl) imgEl.src = recipe.img;
  
  if(categoryEl) {
    let categoryLabel = recipe.category;
    if(categoryLabel === 'high-protein') categoryLabel = 'High Protein';
    if(categoryLabel === 'quick') categoryLabel = 'Quick Meal';
    if(categoryLabel === 'bbq') categoryLabel = 'BBQ Grilling';
    categoryEl.innerText = categoryLabel;
  }
  if(timeEl) timeEl.innerText = "Prep Time: " + recipe.time;
  if(descEl) descEl.innerText = recipe.description;

  // Render Ingredients
  const ingredientsList = document.getElementById('modalRecipeIngredients');
  if(ingredientsList) {
    ingredientsList.innerHTML = '';
    recipe.ingredients.forEach(ing => {
      ingredientsList.innerHTML += `<li>${ing}</li>`;
    });
  }

  // Render Instructions
  const instructionsList = document.getElementById('modalRecipeInstructions');
  if(instructionsList) {
    instructionsList.innerHTML = '';
    recipe.instructions.forEach(inst => {
      instructionsList.innerHTML += `<li class="mb-2">${inst}</li>`;
    });
  }
  
  // Re-trigger the custom CSS animation
  const modalBody = document.querySelector('.zoom-in-animation');
  if(modalBody){
      modalBody.style.animation = 'none';
      modalBody.offsetHeight; /* trigger reflow */
      modalBody.style.animation = null; 
  }
}

// Initial Load
if (recipeContainer) {
  displayRecipes(recipes);
}

// Filter and Search Logic
let currentFilter = 'all';
let searchQuery = '';

function updateDisplay() {
  const filteredRecipes = recipes.filter(recipe => {
    const matchesFilter = currentFilter === 'all' || recipe.category === currentFilter;
    const matchesSearch = recipe.title.toLowerCase().includes(searchQuery.toLowerCase());
    return matchesFilter && matchesSearch;
  });
  displayRecipes(filteredRecipes);
}

// Event Listeners for Filters
if(filterBtns) {
  filterBtns.forEach(btn => {
    btn.addEventListener('click', (e) => {
      // Remove active class from all buttons
      filterBtns.forEach(b => b.classList.remove('active'));
      // Add active class to clicked button
      e.target.classList.add('active');
      
      currentFilter = e.target.getAttribute('data-filter');
      updateDisplay();
    });
  });
}

// Event Listener for Search
if (searchInput) {
  searchInput.addEventListener('input', (e) => {
    searchQuery = e.target.value;
    updateDisplay();
  });
}

// Scroll Animation Logic
document.addEventListener("DOMContentLoaded", () => {
  const scrollElements = document.querySelectorAll('.scroll-animate');
  
  const elementInView = (el, dividend = 1) => {
    const elementTop = el.getBoundingClientRect().top;
    return (elementTop <= (window.innerHeight || document.documentElement.clientHeight) / dividend);
  };
  
  const displayScrollElement = (element) => {
    element.classList.add('scrolled');
  };
  
  const handleScrollAnimation = () => {
    scrollElements.forEach((el) => {
      if (elementInView(el, 1.15)) {
        displayScrollElement(el);
      } 
    })
  }

  // Trigger once on load to show elements that are already in viewport
  handleScrollAnimation();
  
  window.addEventListener('scroll', () => {
    handleScrollAnimation();
  });
});
