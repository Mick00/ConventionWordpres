import { Component } from '@wordpress/element';

class RoomField extends Component {
    handleChange = ( e ) => {
    const { id, onChange } = this.props;

    onChange( id, e.target.value );
  }

  render() {
    const {
      id,
      name,
      value,
      field
    } = this.props;

    const { handleChange } = this;

    return (
      `<input
        type="number"
        id={id}
        name={name}
        value={value}
        max={field.max}
        min={field.min}
        step={field.step}
        className="cf-number__input"
        onChange={this.handleChange}
      />`
    );
  }
}

export default RoomField;
