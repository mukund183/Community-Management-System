
    // Place your JavaScript code here
    function redirectToPage(page) {
        console.log("Redirecting to page:", page);
        window.location.href = page;
    }

document.getElementById("submit").addEventListener("click", function () {
    var selectMember = document.getElementById("selectMember").value;
    console.log("Selected member:", selectMember);
    if (selectMember == "Resident") {
        redirectToPage('/CommunityConnect(1)/CommunityConnect/New folder/Web/admin/Vm_Resident.html');
    } else if (selectMember == "Security") {
        redirectToPage('/CommunityConnect(1)/CommunityConnect/New folder/Web/admin/Vm_Security.html');
    } else if (selectMember == "President") {
        redirectToPage('/CommunityConnect(1)/CommunityConnect/New folder/Web/admin/Vm_President.html');
    }
});



