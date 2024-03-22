
document.addEventListener("DOMContentLoaded", function() {
    const expandText = (elementId) => {
        const element = document.getElementById(elementId);
        const fullText = element.getAttribute('data-fulltext');
        element.innerHTML = fullText;
        const btnId = elementId + "-btn";
        const btn = document.getElementById(btnId);
        btn.style.display = 'none';
    };

    const collapseContent = (content, elementId) => {
        const linesToShow = 200;
        const lineHeight = parseInt(window.getComputedStyle(content).lineHeight);
        const fullText = content.innerHTML;
        const btnHtml = `<a id="${elementId}-btn" class="mt-2" style="cursor: pointer; color:black">Voir plus</a>`;

        content.style.maxHeight = `${linesToShow * lineHeight}px`;
        content.style.overflow = 'hidden';
        content.setAttribute('data-fulltext', fullText);
        content.innerHTML = fullText.split(' ').slice(0, 180).join(' ') + '...'; // Approximation, adjust accordingly
        content.insertAdjacentHTML('afterend', btnHtml);

        document.getElementById(`${elementId}-btn`).addEventListener('click', () => expandText(elementId));
    };

    const descriptionContent = document.getElementById('descriptionText');
    const rulesContent = document.getElementById('rulesText');
    collapseContent(descriptionContent, 'descriptionText');
    collapseContent(rulesContent, 'rulesText');
});

