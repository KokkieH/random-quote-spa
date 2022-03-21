import './App.css';
import quill from './quill.png';
import quill2 from './quill2.png';

function App() {
  return (
    <div className="App">
      <div className="content">
        <h1>Thus wrote the Bard...</h1>
        <div className="centered">
          <p id="printQuote">This is a quote</p>
          <p id="author">- William Shakespeare</p>
          <img id="button" src={quill} alt="new quote button" 
          onMouseOver={e => (e.currentTarget.src=quill2)}
          onMouseOut={e => (e.currentTarget.src=quill)}
          onclick="generateQuote();" />
        </div>
      </div>
    <footer className="footer">
      Powered by the STANDS4 Web Services <a href="http://www.quotes.net/quotes_api.php">Quotes API</a>
    </footer>
  </div>
  );
}

export default App;
