
// Place your JavaScript code here
function redirectToPage(page) {
    console.log("Redirecting to page:", page);
    window.location.href = page;
}

document.getElementById("submit").addEventListener("click", function () {
    var selectMember = document.getElementById("selectMember").value;
    console.log("Selected member:", selectMember);
    if (selectMember == "Resident") {
        redirectToPage('/CommunityConnect(1)/CommunityConnect/New folder/Web/Resident/Vm_Resident.html');
    } else if (selectMember == "Security") {
        redirectToPage('/CommunityConnect(1)/CommunityConnect/New folder/Web/Resident/Vm_Security.html');
    } else if (selectMember == "President") {
        redirectToPage('/CommunityConnect(1)/CommunityConnect/New folder/Web/Resident/Vm_President.html');
    }
});

document.getElementById("addVisitorForm").addEventListener("submit", function (event) {
    event.preventDefault(); // Prevent form submission
    var passcode = document.getElementById("passcode").value;
    // Send passcode to backend for verification
    fetch("verify_passcode.php", {
        method: "POST",
        body: JSON.stringify({ passcode: passcode }),
        headers: {
            "Content-Type": "application/json"
        }
    })
    .then(response => response.text())
    .then(message => {
        alert(message); // Show response message from backend
    })
    .catch(error => {
        console.error("Error:", error);
    });
});




