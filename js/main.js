const householdSelect = document.getElementById('newHousehold');
const householdCodeInput = document.getElementById('householdCode');

householdSelect.addEventListener('change', () => {
    const householdSelectedOption = householdSelect.options[householdSelect.selectedIndex].value;
    if (householdSelectedOption === 'admin') {
        householdCodeInput.style.display = 'none';
    } else {
        householdCodeInput.style.display = 'block';
    }
})
