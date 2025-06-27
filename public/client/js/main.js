
    let index = 0;
    let listButton = document.querySelectorAll('#banner-dots li button');
    document.getElementById('pic').src = img[0];
    if (listButton[0]) {
        listButton[0].style.backgroundColor = '#FF9B42';
    }
    document.getElementById('right').addEventListener('click', function () {
        index++;
        if (index >= img.length) index = 0;
        updateBanner();
    });
    document.getElementById('left').addEventListener('click', function () {
        index--;
        if (index < 0) index = img.length - 1;
        updateBanner();
    });
    function indexNumber(num) {
        index = num;
        updateBanner();
    }
    function updateBanner() {
        document.getElementById('pic').src = img[index];
        listButton.forEach(btn => btn.style.backgroundColor = 'transparent');
        if (listButton[index]) {
            listButton[index].style.backgroundColor = '#FF9B42';
        }
    }
    setInterval(() => {
        index++;
        if (index >= img.length) index = 0;
        updateBanner();
    }, 3000);


