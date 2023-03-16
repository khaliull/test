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
      result: window.result
    }
  }

  render() {

    return (
      <div>
      {this.state.test && this.state.test.type == 'asnwerTest' ? (
        <>
        <table className="table table-bordered test-table mb-5">
          <thead>
            <tr>
              <th scope="col" width="10%">Номер<br />вопроса</th>
              <th scope="col" width="40%">Вопрос</th>
              <th scope="col" width="25%">Ваш ответ</th>
              <th scope="col" width="25%">Правильный вариант ответа</th>
            </tr>
          </thead>
          <tbody>
            {this.state.questions.map((question, key) => (
              <tr key={key}>
                <th scope="row">{question.position + 1}</th>
                <td>{question.name}</td>
                <td className={`${question.answer == question.correct_answer ? 'result-success' : 'result-error'}`}>{question.answer}</td>
                <td>{question.correct_answer}</td>
              </tr>
            ))}

          </tbody>
        </table>
        <h4 className="mb-3">Общая статистика теста</h4>
        <Chart data={this.state.result} />
        </>
      ) : this.state.test.type == 'pairedTest' ? (
        <PairedTest results={this.state.result} test={this.state.test} />
      ) : null}

      </div>
    )
  }
}

const element = document.querySelector('.result-test-show')

if (element) {
  ReactDOM.render(<QuestionCreate />, element)
}
