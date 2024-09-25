function MakeSideBar(array) {
    let sideBtns = [];

    for (let i = 0; i < array.length; i++) {
        sideBtns.push(`
            <a href="${array[i].link}">
                <div class="icon">${array[i].svg}</div>
                <p>${array[i].name}</p>
            </a>
        `);
    }

    document.getElementById('sidebar').innerHTML = sideBtns.join('');
}

