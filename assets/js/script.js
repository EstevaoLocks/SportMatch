// Classe 'active' navbar
const navbarLinks = document.querySelectorAll('nav li a');
const urlAtual = window.location.pathname.split('/').pop();

navbarLinks.forEach(link => {
  let href = link.getAttribute('href');
  if (href === urlAtual) {
    link.parentElement.classList.add('active');
  }
});

// Possbilita manipular SVGs diretamente no DOM (no CSS)
function imgToSVGElement(elementId) {

    let img = document.getElementById(elementId);
    let src = img.getAttribute("src");
    
    fetch(src)
        // Busca o arquivo SVG
        .then(res => res.text())
        .then(svg => {
            let parser = new DOMParser();
            let svgDoc = parser.parseFromString(svg, "image/svg+xml");
    
            let svgElement = svgDoc.querySelector("svg");
            svgElement.id = elementId; // Mantém o mesmo ID
            svgElement.classList = img.classList; // Mantém as mesmas classes

            // Substitui o <img> pelo <svg>
            img.replaceWith(svgElement);
        });
} // end function imgToSVGElement
// end of SVG manipulation

// Chama a função para os ícones
// Icone Person Button Menu
imgToSVGElement("iconePersonBtnMenu");

// Icones Local Cards Section "Perto de Você"
imgToSVGElement("iconeLocalCard1");
imgToSVGElement("iconeLocalCard2");
imgToSVGElement("iconeLocalCard3");
imgToSVGElement("iconeLocalCard4");

// Ícones links Contato Footer
imgToSVGElement("iconeTelefone-Footer");
imgToSVGElement("iconeEmail-Footer");
imgToSVGElement("iconeWhatsapp-Footer");
imgToSVGElement("iconeLocal-Footer");