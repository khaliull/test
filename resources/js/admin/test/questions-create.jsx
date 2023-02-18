import React from 'react'
import ReactDOM from 'react-dom'
import Select from 'react-select'
import axios from 'axios';

class QuestionCreate extends React.Component {
  constructor(props) {
    super(props)

    this.state = {
      test: window.test,
      questions: window.questions,
      active: 0,
      type: null,
      answer: '',
      answers: [],
      name: null,
      options : [
        { value: 'text', label: 'Письменный ответ на вопрос' },
        { value: 'selectDropdown', label: 'Выбор ответа из выпадающего списка' },
        { value: 'selectRadio', label: 'Выбор ответа' },
      ]
    }

    this.addAnswer = this.addAnswer.bind(this)

  }

  addAnswer() {
    let array = this.state.answers
    array.push([this.state.answer])
    this.setState({answers: array, answer: ''})
  }

  async saveAnswer() {
    const form = new FormData()

    form.append('name', this.state.name)
    form.append('type', this.state.type)

    if (this.state.type == 'selectDropdown' || this.state.type == 'selectRadio') {
      this.state.answers.forEach(answer => form.append('data[]', answer))
    } else {
      form.append('data', null)
    }

    let response

    try {

      response = await axios.post('/admin/test/' + test.id + '/questions/create', form)

    } catch(error) {

      alert('Произошла ошибка, попробуйте еще раз')

      return
    }
    console.log(response.data)
    let array = this.state.questions
    array.push(response.data)
    this.setState({questions: array})
  }

  render() {

    return (
      <div>
        <div>
          <h5>Добавить вопрос</h5>
          <div>{    console.log(this.state.questions)}
            <Select className="mb-3" onChange={(e) => this.setState({type: e.value, answers: []})} options={this.state.options} />
            {this.state.type && (
              <div className="mb-3">
                <label htmlFor="textName" className="form-label">Введите вопрос</label>
                <input type="text" onChange={(e) => this.setState({name: e.target.value})} className="form-control" id="textName" />
              </div>
            )}
            {(this.state.type == 'selectDropdown' || this.state.type == 'selectRadio') && (
            <div className="mb-3">
              <label htmlFor="textName" className="form-label">Вариант ответа</label>
              <input value={this.state.answer} type="text" onChange={(e) => this.setState({answer: e.target.value})} className="form-control mb-3" id="textName" />
              <button disabled={!this.state.answer} className="btn btn-primary" onClick={() => this.addAnswer()}>Добавить вариант ответа</button>
            </div>
            )}
            {this.state.type == 'text' ? (
              <button disabled={!this.state.name} className="btn btn-primary" onClick={() => this.saveAnswer()}>Добавить вопрос</button>
            ) : (this.state.type == 'selectDropdown' || this.state.type == 'selectRadio') && (
              <button disabled={(!this.state.name || this.state.answers.length == 0)} className="btn btn-primary" onClick={() => this.saveAnswer()}>Добавить вопрос</button>
            )}
          </div>
        </div>
        <h6 className="mt-3">Все вопросы</h6>
        {this.state.questions.map((question, index) => (
          <div key={index} className="card card-body mb-1">
          <h6 className="mb-3">Вопрос №{question.position}: {question.name}</h6>
          <ul className="mb-0">
            {question.data && question.data.select && question.data.select.map((value) => (
              <li>{value}</li>
            ))}
            </ul>
          </div>
        ))}
      </div>
    )
  }
}

const element = document.querySelector('.test-question-create')

if (element) {
  ReactDOM.render(<QuestionCreate />, element)
}
