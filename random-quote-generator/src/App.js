import './App.css';
import quill from './quill.png';
import quill2 from './quill2.png';
import { useState } from 'react';

var current = 0;

function App() {

  const quotes = [
    'All the world’s a stage,\nAnd all the men and women merely\xa0players',
    'To be, or not to be:\nThat is the\xa0question',
    'What is in a name?\nThat which we call a rose by any other name would smell as\xa0sweet',
    'Love all, trust a few, do wrong to\xa0none',
    'Be not afraid of greatness.\nSome are born great, some achieve greatness, and others have greatness thrust upon\xa0them',
    'Hell is empty and all the devils are\xa0here',
    'By the pricking of my thumbs,\nSomething wicked this way\xa0comes'
  ];

  const val = quotes.length;

  // generates a random number between 0 and length of the quotes array
  function randomNumber(val) { 
    return Math.floor(Math.random() * val);
  }

  function getQuote() {
    var random = randomNumber(val);
    // checks index of current quote to ensure the same quote doesn't show twice in a row
    if (random === current && random === val-1) { 
      random--;
    } 
    else if (random === current) {
      random++;
    }
    current = random;
    return quotes[random];
  }

  const [currentQuote, setQuote] = useState(quotes[randomNumber(val)]);

  const [inkpot, setQuill] = useState(quill);

  return (
    <div className="App">
      <div className="content">
        <h1>Thus wrote the Bard...</h1>
        <div className="centered">
          <p id="printQuote">{currentQuote}</p>
          <p id="author">- William Shakespeare</p>
          <img 
            id="button" 
            src={inkpot} 
            alt="new quote button" 
            onMouseOver={() => setQuill(quill2)}
            onMouseOut={() => setQuill(quill)}
            onClick={() => setQuote(getQuote())} 
          />
        </div>
      </div>
    <footer className="footer">
      Powered by the STANDS4 Web Services <a href="http://www.quotes.net/quotes_api.php">Quotes API</a>
    </footer>
  </div>
  );
}

export default App;
