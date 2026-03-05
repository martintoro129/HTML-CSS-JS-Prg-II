const cards = [
    {
        "title": "Paris",
        "description": "The romantic city of lights, known for the Eiffel Tower, charming cafes, and world-class art museums.",
        "image": "assets/paris.jpg"
    },
    {
        "title": "Kyoto",
        "description": "A city of timeless beauty, with ancient temples, traditional teahouses, and stunning cherry blossoms.",
        "image": "assets/kyoto.jpg"
    },
    {
        "title": "New York City",
        "description": "The city that never sleeps, featuring iconic skyscrapers, Broadway shows, and diverse culture.",
        "image": "assets/new_york.jpg"
    },
    {
        "title": "Cape Town",
        "description": "A coastal gem with Table Mountain, golden beaches, and vibrant local markets.",
        "image": "assets/cape-town.jpg"
    },
    {
        "title": "Barcelona",
        "description": "A vibrant city filled with Gaudí architecture, sunny beaches, and delicious tapas.",
        "image": "assets/barcelona.jpg"
    },
    {
        "title": "Istanbul",
        "description": "Where East meets West — a city of rich history, grand mosques, and bustling bazaars.",
        "image": "assets/istanbul.jpg"
    },
    {
        "title": "Sydney",
        "description": "Famous for its iconic Opera House, beautiful harbor, and laid-back beach lifestyle.",
        "image": "assets/sydney.jpg"
    },
    {
        "title": "Rio de Janeiro",
        "description": "A vibrant city known for its Carnival, Christ the Redeemer statue, and stunning beaches.",
        "image": "assets/rio.jpg"
    },
    {
        "title": "Amsterdam",
        "description": "A charming canal-filled city with historic houses, museums, and a love for bicycles.",
        "image": "assets/amsterdam.jpg"
    },
    {
        "title": "Rome",
        "description": "A city steeped in history, with ancient ruins, grand piazzas, and mouthwatering Italian cuisine.",
        "image": "assets/rome.jpg"
    },
    {
        "title": "Bangkok",
        "description": "A lively metropolis blending traditional temples with vibrant street life and markets.",
        "image": "assets/bangkok.jpg"
    },
    {
        "title": "Reykjavik",
        "description": "A small but stunning city surrounded by glaciers, geysers, and the Northern Lights.",
        "image": "assets/reykjavik.jpg"
    },
    {
        "title": "Lisbon",
        "description": "A coastal capital with pastel buildings, tram-lined streets, and delicious pastries.",
        "image": "assets/lisbon.jpg"
    },
    {
        "title": "Prague",
        "description": "A fairytale city with cobblestone streets, Gothic castles, and the iconic Charles Bridge.",
        "image": "assets/prague.jpg"
    },
    {
        "title": "Marrakech",
        "description": "A colorful city of souks, spices, palaces, and the stunning Atlas Mountains nearby.",
        "image": "assets/marrakech.jpg"
    },
    {
        "title": "Vancouver",
        "description": "A scenic city nestled between the mountains and ocean, with modern vibes and outdoor adventures.",
        "image": "assets/vancouver.jpg"
    },
    {
        "title": "Buenos Aires",
        "description": "A passionate city full of tango, European-style boulevards, and rich culture.",
        "image": "assets/buenos-aires.jpg"
    },
    {
        "title": "Singapore",
        "description": "A futuristic city-state with lush gardens, diverse food, and sparkling architecture.",
        "image": "assets/singapore.jpg"
    },
    {
        "title": "Dubrovnik",
        "description": "A historic walled city on the Adriatic coast with stunning sea views and medieval charm.",
        "image": "assets/dubrovnik.jpg"
    },
    {
        "title": "Santorini",
        "description": "A dreamy island city with whitewashed houses, blue domes, and breathtaking sunsets.",
        "image": "assets/santorini.jpg"
    }
];

const cardsElement = document.querySelector('.cards');
const itemsPerPage = 3;
let currentPage = Math.min(Math.max(parseInt(
    new URLSearchParams(window.location.search).get('page')) || 1, 1), Math.ceil(cards.length / itemsPerPage)
);
const totalPages = Math.ceil(cards.length / itemsPerPage);

const previousPageButton = document.getElementById('go-to-previous-page');
const nextPageButton = document.getElementById('go-to-next-page');
const pagesContainer = document.getElementById('pages');

const setButtonState = (button, isDisabled) => {
    button.disabled = isDisabled;
    button.classList.toggle('pagination__button--disabled', isDisabled);
};

const changeCards = (cards, pageIndex, itemsPerPage) => {
    const startIndex = (pageIndex - 1) * itemsPerPage;
    const endIndex = startIndex + itemsPerPage;

    cardsElement.innerHTML = cards.slice(startIndex, endIndex).map(card => `
        <article>
            <figure>
                <img src="${card.image}" alt="${card.title}"
                    onerror="this.src='assets/default.png'; this.alt='Image not available';"
                >
            </figure>
            <div class="article-preview">
                <h2>${card.title}</h2>
                <p>${card.description}</p>
            </div>
        </article>
    `).join('');

    currentPage = pageIndex;
    setButtonState(previousPageButton, currentPage === 1);
    setButtonState(nextPageButton, currentPage === totalPages);
    generatePageLinks();

    if (window.location.search !== `?page=${currentPage}`) {
        window.history.pushState({}, '', `?page=${currentPage}`);
    }
};

const generatePageLinks = () => {
    pagesContainer.innerHTML = '';
    const maxVisiblePages = 3;
    let pages = [];

    if (totalPages <= maxVisiblePages + 2) {
        for (let i = 1; i <= totalPages; i++) pages.push(i);
    } else {
        pages.push(1);
        let start = Math.max(2, currentPage - 1);
        let end = Math.min(totalPages - 1, currentPage + 1);

        if (start > 2) pages.push('...');
        for (let i = start; i <= end; i++) pages.push(i);
        if (end < totalPages - 1) pages.push('...');
        pages.push(totalPages);
    }

    pages.forEach(page => {
        if (page === '...') {
            const dost = document.createElement('span');
            dost.textContent = '...';
            dost.classList.add('pagination__dots');
            pagesContainer.appendChild(dost);
        } else {
            const pageLink = document.createElement('a');
            pageLink.textContent = page;
            pageLink.href = `?page=${page}`;
            pageLink.classList.toggle('pagination__link--active', currentPage === page);
            pageLink.addEventListener('click', (event) => {
                event.preventDefault();
                changeCards(cards, page, itemsPerPage);
            });
            pagesContainer.appendChild(pageLink);
        }
    });
};

document.addEventListener('DOMContentLoaded', () => {
    changeCards(cards, currentPage, itemsPerPage);
});

previousPageButton.addEventListener('click', () => {
    if (currentPage > 1) changeCards(cards, currentPage - 1, itemsPerPage);
});

nextPageButton.addEventListener('click', () => {
    if (currentPage < totalPages) changeCards(cards, currentPage + 1, itemsPerPage);
});

window.addEventListener('keydown', (event) => {
    const key = event.key.toLowerCase();
    if (key === 'arrowleft' || key === 'left') {
        if (currentPage > 1) changeCards(cards, currentPage - 1, itemsPerPage);
    } else if (key === 'arrowright' || key === 'right') {
        if (currentPage < totalPages) changeCards(cards, currentPage + 1, itemsPerPage);
    }
});
