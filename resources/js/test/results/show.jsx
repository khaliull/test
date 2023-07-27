import React from 'react'
import ReactDOM from 'react-dom'
import Select from 'react-select'
import axios from 'axios';
import Chart from './chart';
import PairedTest from './paired/index';

class QuestionCreate extends React.Component {
  constructor(props) {
    super(props)

    this.state = {
      test: window.test,
      questions: window.questions,
      result: window.result,
      text: window.text,
      facts: window.facts,
      progress: window.progress,
    }
  }

  render() {

    return (
      <div>
        {this.state.test && this.state.test.result == 'answer' ? (
          <>
            <h4 className="mb-3 fw-light">Общая статистика теста</h4>
            <Chart data={this.state.result} />
            <div className="mt-5">
            Вы ответили правильно по 100 бальной шкале:
              <div className="progress test-progress mt-3">
                <div className={`progress-bar text-danger ${this.state.progress < 0.4 ? 'test-progress-bar-danger' : 'test-progress-bar-success' }`} role="progressbar" style={{width: this.state.progress * 100 +'%'}} aria-valuenow="1" aria-valuemin="1" aria-valuemax="100"></div>
              </div>
            </div>
          </>
        ) : this.state.test.result == 'paired' ? (
          <PairedTest results={this.state.result} test={this.state.test} />
        ) : null}
        <div className="row justify-content-center mt-5">
          <div className="col-lg-6">
            <p className="pb-4 border-bottom border-danger border-2">Вывод: {this.state.text}</p>
            <h5>Интересные факты</h5>
            {this.state.facts.map((fact, index) => (
              <p className="fact-show" key={index}>{fact.content}</p>
            ))}
          </div>
        </div>
      </div>
    )
  }
}

const element = document.querySelector('.result-test-show')

if (element) {
  ReactDOM.render(<QuestionCreate />, element)
}
