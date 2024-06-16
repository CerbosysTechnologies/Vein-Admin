<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.1/flowbite.min.js"></script>
<script>
    /*Toggle dropdown list*/
    function toggleDD(myDropMenu) {
        document.getElementById(myDropMenu).classList.toggle("invisible");
    }
    /*Filter dropdown options*/
    function filterDD(myDropMenu, myDropMenuSearch) {
        var input, filter, ul, li, a, i;
        input = document.getElementById(myDropMenuSearch);
        filter = input.value.toUpperCase();
        div = document.getElementById(myDropMenu);
        a = div.getElementsByTagName("a");
        for (i = 0; i < a.length; i++) {
            if (a[i].innerHTML.toUpperCase().indexOf(filter) > -1) {
                a[i].style.display = "";
            } else {
                a[i].style.display = "none";
            }
        }
    }
    // Close the dropdown menu if the user clicks outside of it
    window.onclick = function(event) {
        if (!event.target.matches(".drop-button") && !event.target.matches(".drop-search")) {
            var dropdowns = document.getElementsByclass("dropdownlist");
            for (var i = 0; i < dropdowns.length; i++) {
                var openDropdown = dropdowns[i];
                if (!openDropdown.classList.contains("invisible")) {
                    openDropdown.classList.add("invisible");
                }
            }
        }
    };
</script>
<script>
    /*Toggle dropdown list*/
    function toggleDD(myDropMenu) {
        document.getElementById(myDropMenu).classList.toggle("invisible");
    }
    /*Filter dropdown options*/
    function filterDD(myDropMenu, myDropMenuSearch) {
        var input, filter, ul, li, a, i;
        input = document.getElementById(myDropMenuSearch);
        filter = input.value.toUpperCase();
        div = document.getElementById(myDropMenu);
        a = div.getElementsByTagName("a");
        for (i = 0; i < a.length; i++) {
            if (a[i].innerHTML.toUpperCase().indexOf(filter) > -1) {
                a[i].style.display = "";
            } else {
                a[i].style.display = "none";
            }
        }
    }
    // Close the dropdown menu if the user clicks outside of it
    window.onclick = function(event) {
        if (!event.target.matches(".drop-button") && !event.target.matches(".drop-search")) {
            var dropdowns = document.getElementsByclass("dropdownlist");
            for (var i = 0; i < dropdowns.length; i++) {
                var openDropdown = dropdowns[i];
                if (!openDropdown.classList.contains("invisible")) {
                    openDropdown.classList.add("invisible");
                }
            }
        }
    };
</script>
<!-- dropdown start -->
<script>
    /* Loop through all dropdown buttons to toggle between hiding and showing its dropdown content - This allows the user to have multiple dropdowns without any conflict */
    var dropdown = document.getElementsByClassName("dropdown-btn");
    var i;
    for (i = 0; i < dropdown.length; i++) {
        dropdown[i].addEventListener("click", function() {
            this.classList.toggle("active");
            var dropdownContent = this.nextElementSibling;
            let icon = this.children[2];
            if (dropdownContent.style.display === "block") {
                dropdownContent.style.display = "none";
                icon.style.transform = "rotate(0deg)";
            } else {
                dropdownContent.style.display = "block";
                icon.style.transform = "rotate(90deg)";
            }
        });
    }
</script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<!-- all active button start -->
<script>
    // Add active class to the current button (highlight it)
    var header = document.getElementById("myDIV");
    var btns = header.getElementsByClassName("btn");
    for (var i = 0; i < btns.length; i++) {
        btns[i].addEventListener("click", function() {
            var current = document.getElementsByClassName("active");
            current[0].className = current[0].className.replace(" active", "");
            this.className += " active";
        });
    }
</script>
<!-- all -->

<!-- responsive sidebar js start -->
<script>
    let menuicn = document.querySelector(".menuicn");
    let nav = document.querySelector(".navcontainer");
    menuicn.addEventListener("click", () => {
        nav.classList.toggle("navclose");
    });
</script>

<!--user dropdown input start-->
<script>
    function myUser() {
        
        document.getElementById("myDropdown").classList.toggle("show");
    }
    // Close the dropdown if the user clicks outside of it
    window.onclick = function(event) {
        if (!event.target.matches('.dropbtn')) {
            var dropdowns = document.getElementsByClassName("dropdown-content");
            var i;
            for (i = 0; i < dropdowns.length; i++) {
                var openDropdown = dropdowns[i];
                if (openDropdown.classList.contains('show')) {
                    openDropdown.classList.remove('show');
                }
            }
        }
    }
</script>
<!--end user dropdown input end -->
<!-- end -->

<script>
    var item_Id;
    // Function to open the delete popup
    function deleteOpen(itemId, itemType) {
        let pop = $("#delete-popup-" + itemType);
        let deleteButton = pop.find(".delete-button-" + itemType);
        console.log(138,deleteButton);
        item_Id = itemId
        deleteButton.data('item-id', itemId);
        console.log('139', itemId, "::", itemType);
        pop.css('display', 'flex');
    }

    // Event handler for clicking the delete button
    $(document).on('click', '.delete-button', function() {
        var itemId = $(this).data('item-id');
        var itemType = $(this).data('item-type');
        console.log('147', item_Id + "::", itemType);
        removeItem(item_Id, itemType);
    });

    // Function to remove the item via AJAX
    function removeItem(itemId, itemType) {
    $.ajax({
        url: '/admin/' + itemType + '/' + itemId,
        type: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response) {
            console.log(response);
            window.location.reload(); 
            Delete_Close(itemType); 
        },
        error: function(xhr) {
            console.log(xhr.responseText);
        }
    });
    }


    // Function to close the delete popup
    function Delete_Close(itemType) {
        let pop = $("#delete-popup-" + itemType);
        pop.css('display', 'none');
    }


    // function for adding the price of test and numbers of tests in packages table
    function toggleDropdown() {
        var
            dropdownContent = document.getElementById("dropdown-content");
        if (dropdownContent.style.display === "block") {
            dropdownContent.style.display = "none";
        } else {
            dropdownContent.style.display = "block";
        }
    }

    function updateTotalCount() {
        var checkboxes = document.querySelectorAll('#dropdown-content input[type="checkbox"]');
        var totalCountInput = document.getElementById('total_test_included');
        var totalPriceInput = document.getElementById('price');
        var totalCount = 0;
        var totalPrice = 0;
        checkboxes.forEach(function(checkbox) {
            if (checkbox.checked) {
                totalCount++;
                var
                    testPrice = parseFloat(checkbox.getAttribute('data-price'));
                totalPrice += testPrice;
            }
        });
        totalCountInput.value = totalCount;
        totalPriceInput.value = totalPrice.toFixed(2);
    }

    // Image Preview after selecting
    function previewImage(event, imageId) {
        console.log(event, "::", imageId);
        const input = event.target;
        const file = input.files[0];

        if (file) {
            const reader = new FileReader();

            reader.onload = function(e) {
                const image = document.getElementById(imageId);
                if (image) {
                    image.src = e.target.result;
                } else {
                    console.error("Image element not found with id: " + imageId);
                }
            };

            reader.readAsDataURL(file);
        }
    }
</script>


<script>
    document.addEventListener("DOMContentLoaded", function () {
        const name_en = document.getElementById('name_en');
        const name_hi = document.getElementById('name_hi');
        const name_mr = document.getElementById('name_mr');

        const description_en = document.getElementById('description_en');
        const description_hi = document.getElementById('description_hi');
        const description_mr = document.getElementById('description_mr');

        // Function to translate text
        async function translateText(text, sourceLang, targetLang) {
            const response = await fetch(`https://api.mymemory.translated.net/get?q=${text}&langpair=${sourceLang}|${targetLang}`);
            const data = await response.json();
            return data.responseData.translatedText;
        }

        // Event listener for input in English name field
        name_en.addEventListener('input', async () => {
            const englishTextName = name_en.value.trim();
            if (englishTextName !== '') {
                try {
                    // Translate to Hindi
                    const hindiTranslation = await translateText(englishTextName, 'en', 'hi');
                    name_hi.value = hindiTranslation;

                    // Translate to Marathi
                    const marathiTranslation = await translateText(englishTextName, 'en', 'mr');
                    name_mr.value = marathiTranslation;
                } catch (error) {
                    console.error('Translation Error:', error);
                }
            } else {
                name_hi.value = '';
                name_mr.value = '';
            }
        });

        // Event listener for input in Hindi description field
        description_en.addEventListener('input', async () => {
            const englishTextDescription = description_en.value.trim();
            if (englishTextDescription !== '') {
                try {
                    const hindiTranslation = await translateText(englishTextDescription, 'en', 'hi');
                    description_hi.value = hindiTranslation;

                    // Translate to Marathi
                    const marathiTranslation = await translateText(englishTextDescription, 'en', 'mr');
                    description_mr.value = marathiTranslation;
                } catch (error) {
                    console.error('Translation Error:', error);
                }
            } else {
                description_hi.value = '';
                description_mr.value = '';
            }
        });

       
    });
</script>

<!--ck editor js-->
<script>
    CKEDITOR.replace('editor', {
      skin: 'moono',
      enterMode: CKEDITOR.ENTER_BR,
      shiftEnterMode: CKEDITOR.ENTER_P,
      toolbar: [{
        name: 'basicstyles',
        groups: ['basicstyles'],
        items: ['Bold', 'Italic', 'Underline', "-", 'TextColor', 'BGColor']
      }, {
        name: 'styles',
        items: ['Format', 'Font', 'FontSize']
      }, {
        name: 'scripts',
        items: ['Subscript', 'Superscript']
      }, {
        name: 'justify',
        groups: ['blocks', 'align'],
        items: ['JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock']
      }, {
        name: 'paragraph',
        groups: ['list', 'indent'],
        items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent']
      }, {
        name: 'links',
        items: ['Link', 'Unlink']
      }, {
        name: 'insert',
        items: ['Image']
      }, {
        name: 'spell',
        items: ['jQuerySpellChecker']
      }, {
        name: 'table',
        items: ['Table']
      }],
    });
</script>
<!--end ck editor-->

<script>
// Image preview for featured image
document.getElementById('featured_image').addEventListener('change', function(event) {
    var featuredImage = event.target.files[0];
    var featuredImagePreview = document.getElementById('featured_image_preview');
    featuredImagePreview.style.display = 'block';
    featuredImagePreview.src = URL.createObjectURL(featuredImage);
});

document.getElementById('other_images').addEventListener('change', function(event) {
    var files = event.target.files;
    var imagesPreview = document.getElementById('other_images_preview');
    imagesPreview.innerHTML = '';

    if (files.length > 4) {
        alert('You can only upload a maximum of 4 images.');
        event.target.value = ''; 
        return;
    }

    for (var i = 0; i < files.length; i++) {
        var image = document.createElement('img');
        image.src = URL.createObjectURL(files[i]);
        image.style.height = '100px';
        image.style.width = 'auto';
        imagesPreview.appendChild(image);
    }
});

function toggleDescription(blogId) {
    var dots = document.getElementById("dots" + blogId);
    var moreText = document.getElementById("more" + blogId);
    var btnText = document.getElementById("readMoreBtn" + blogId);

    if (dots.style.display === "none") {
        dots.style.display = "inline";
        btnText.textContent = "Read more";
        moreText.style.display = "none";
    } else {
        dots.style.display = "none";
        btnText.textContent = "Read less";
        moreText.style.display = "inline";
    }
}

</script>

<script>
function previewImage(event, previewId) {
        var reader = new FileReader();

        reader.onload = function() {
            var output = document.getElementById(previewId);
            output.src = reader.result;
        };

        reader.readAsDataURL(event.target.files[0]);
    }
</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.getElementById('searchInput');
    const searchIcon = document.getElementById('searchIcon');
    const suggestionsDropdown = document.getElementById('suggestionsDropdown');

   // Function to fetch suggestions from the server
    function fetchSuggestions(query) {
        return fetch(`/admin/api/search?q=${query}`)
            .then(response => response.json())
            .then(data => data.suggestions)
            .catch(error => {
                console.error('Error fetching suggestions:', error);
                return [];
            });
    }


    // Function to fetch suggestions from the server
async function fetchSuggestions(query) {
    const response = await fetch(`/admin/api/search?q=${query}`);
    const data = await response.json();
    
    let suggestions = [];
    
    if (data.users) {
        suggestions = suggestions.concat(data.users.map(user => user.name));
    }
    if (data.package) {
        suggestions = suggestions.concat(data.package.map(package => package.package_name));
    }
    if (data.test) {
        suggestions = suggestions.concat(data.test.map(test => test.test_name));
    }
    if (data.lab) {
        suggestions = suggestions.concat(data.lab.map(lab => lab.name));
    }
    if (data.blog) {
        suggestions = suggestions.concat(data.blog.map(blog => blog.title));
    }
    
    return suggestions;
}

// Function to show dynamic suggestions dropdown
async function showSuggestions() {
    const searchTerm = searchInput.value.trim();
    if (searchTerm === '') {
        suggestionsDropdown.classList.add('hidden');
        return;
    }

    try {
        const suggestions = await fetchSuggestions(searchTerm);
        if (suggestions.length > 0) {
            suggestionsDropdown.innerHTML = '';
            suggestions.forEach(suggestion => {
                const suggestionItem = document.createElement('div');
                suggestionItem.textContent = suggestion;
                suggestionItem.classList.add('p-2', 'cursor-pointer', 'hover:bg-gray-100');
                suggestionItem.addEventListener('click', () => {
                    // Redirect to the suggestion
                    window.location.href = '/search?q=' + suggestion;
                });
                suggestionsDropdown.appendChild(suggestionItem);
            });
            suggestionsDropdown.classList.remove('hidden');
        } else {
            // Hide dropdown if no suggestions
            suggestionsDropdown.classList.add('hidden');
        }
    } catch (error) {
        console.error('Error fetching and displaying suggestions:', error);
        suggestionsDropdown.classList.add('hidden');
    }
}



    // Event listener for search input
    searchInput.addEventListener('input', showSuggestions);

    // Event listener for search icon click
    searchIcon.addEventListener('click', function () {
        const searchTerm = searchInput.value.trim();
        if (searchTerm !== '') {
            // Redirect to search page
            window.location.href = '/search?q=' + searchTerm;
        } else {
            // Show not found page
            window.location.href = '/not-found';
        }
    });

    // Close dropdown when clicking outside
    document.addEventListener('click', function (event) {
        if (!event.target.closest('.search-menu')) {
            suggestionsDropdown.classList.add('hidden');
        }
    });
});
</script>

<script>
    function toggleTimeSlotsForUpdate(appointmentType, startTime, endTime) {
        var slotTimeSelect = document.getElementById('slot_time');
        
        // Clear existing options
        slotTimeSelect.innerHTML = '';
    
        if (appointmentType === 'home') {
            var start = new Date();
            start.setHours(6, 0, 0); // 6:00 AM
            var end = new Date();
            end.setHours(21, 0, 0); // 9:00 PM
    
            while (start <= end) {
                var timeSlot = start.toLocaleString('en-US', { hour: 'numeric', minute: '2-digit', hour12: true });
                var nextHour = new Date(start.getTime() + (60 * 60 * 1000));
                var nextHourSlot = nextHour.toLocaleString('en-US', { hour: 'numeric', minute: '2-digit', hour12: true });
    
                slotTimeSelect.innerHTML += "<option value='" + timeSlot + "'>" + timeSlot + " to " + nextHourSlot + "</option>";
    
                start = nextHour;
            }
        } else if (appointmentType === 'lab') {
            for (var i = 1; i <= 24; i++) {
                var slot = i.toString().padStart(2, '0') + ':00'; // Format slot as HH:00
                var nextHourSlot = ((i + 1) % 24).toString().padStart(2, '0') + ':00'; // Format next hour slot
    
                slotTimeSelect.innerHTML += "<option value='" + slot + "'>" + slot + " to " + nextHourSlot + "</option>";
            }
        }
    
        // Pre-select the saved slot_time if available
        if (startTime && endTime) {
            var savedSlot = startTime + " to " + endTime;
            var option = slotTimeSelect.querySelector('option[value="' + savedSlot + '"]');
            if (option) {
                option.selected = true;
            }
        }
    }
    
    // Call the function with appropriate parameters when the document is ready
    document.addEventListener("DOMContentLoaded", function() {
   
    toggleTimeSlotsForUpdate('home', '08:00:00', '09:00:00');
});

</script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var slotTimeSelect = document.getElementById('slot_time');
        var appointmentTypeSelect = document.getElementById('appointment_type');
        
        function updateSlotTimeOptions(appointmentType) {
            // Clear existing options
            slotTimeSelect.innerHTML = '';

            if (appointmentType === 'home') {
                // Populate time slots for home appointments (6:00 AM to 9:00 PM)
                for (var hour = 6; hour <= 21; hour++) {
                    var timeSlot = hour < 12 ? (hour === 0 ? '12' : hour) + ':00 AM' : (hour === 12 ? '12' : (hour - 12)) + ':00 PM';
                    var nextHourSlot = (hour + 1) % 24 < 12 ? ((hour + 1) % 12 === 0 ? '12' : (hour + 1) % 12) + ':00 AM' : ((hour + 1) % 12 === 0 ? '12' : ((hour + 1) % 12)) + ':00 PM';

                    slotTimeSelect.innerHTML += "<option value='" + timeSlot + "'>" + timeSlot + " to " + nextHourSlot + "</option>";
                }
            } else if (appointmentType === 'lab') {
                // Populate time slots for lab appointments (24-hour format)
                for (var hour = 0; hour < 24; hour++) {
                    var timeSlot = hour < 12 ? (hour === 0 ? '12' : hour) + ':00 AM' : (hour === 12 ? '12' : (hour - 12)) + ':00 PM';
                    var nextHourSlot = (hour + 1) % 24 < 12 ? ((hour + 1) % 12 === 0 ? '12' : (hour + 1) % 12) + ':00 AM' : ((hour + 1) % 12 === 0 ? '12' : ((hour + 1) % 12)) + ':00 PM';

                    slotTimeSelect.innerHTML += "<option value='" + timeSlot + "'>" + timeSlot + " to " + nextHourSlot + "</option>";
                }
            }
        }

        // Update time slots when appointment type changes
        appointmentTypeSelect.addEventListener('change', function() {
            updateSlotTimeOptions(appointmentTypeSelect.value);
        });

        // Initially populate time slots based on the current appointment type
        updateSlotTimeOptions(appointmentTypeSelect.value);
    });
</script>

    
    