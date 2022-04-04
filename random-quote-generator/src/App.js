import './App.css';
import quill from './quill.png';
import quill2 from './quill2.png';
import { useState } from 'react';

function App() {

  function getQuote(e) {
    alert("You clicked the inkpot!")
  }

  const [inkpot, setQuill] = useState(quill)
  
  return (
    <div className="App">
      <div className="content">
        <h1>Thus wrote the Bard...</h1>
        <div className="centered">
          <p id="printQuote">All the world’s a stage,<br />
And all the men and women merely players</p>
          <p id="author">- William Shakespeare</p>
          <img id="button" src={inkpot} alt="new quote button" 
          onMouseOver={() => setQuill(quill2)}
          onMouseOut={() => setQuill(quill)}
          onClick={getQuote} />
        </div>
      </div>
    <footer className="footer">
      Powered by the STANDS4 Web Services <a href="http://www.quotes.net/quotes_api.php">Quotes API</a>
    </footer>
  </div>
  );
}

export default App;
