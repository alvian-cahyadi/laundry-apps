import React from 'react';
import { Button, Form, FormGroup, Label, Input } from 'reactstrap';

class PacketForm extends React.Component {
    state = {
        id: 0,
        packet_id: '',
        packet_name: '',
        packet_price: ''
    }

    onChange = e => {
        this.setState({[e.target.name]: e.target.value})
      }

    submitFormAdd = e => {
        e.preventDefault()
        fetch('http://localhost/siklin/packetsiklin/add_packet', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json;'
            },
            body: JSON.stringify({
                packet_id: this.state.packet_id,
                packet_name: this.state.packet_name,
                packet_price: this.state.packet_price
            })
        })
        .then(response => response.json())
        .then(packet => {
            if(Array.isArray(packet)) {
                this.props.addPacketToState(packet[0])
                this.props.toggle()
            } else {
                console.log('failure')
            }
        })
        .catch('err => console.log(err)')
    }

    submitFormEdit = e => {
        e.preventDefault()
        fetch('http://localhost/siklin/packetsiklin/update_packet', {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                id: this.state.id,
                packet_id: this.state.packet_id,
                packet_name: this.state.packet_name,
                packet_price: this.state.packet_price
            })
        })
        .then(response => response.json())
        .then(packet => {
            if(Array.isArray(packet)){
                this.props.updateState(packet[0])
                this.props.toggle()
            } else {
                console.log('failure')
            }
        })
        .catch(err => console.log(err))
    }

    componentDidMount(){
        // if item exists, populate the state with proper data
        if(this.props.packet){
          const { id, packet_id, packet_name, packet_price } = this.props.packet
          this.setState({ id, packet_id, packet_name, packet_price })
        }
      }

    render() {
        return (
            <Form onSubmit={this.props.packet ? this.submitFormEdit : this.submitFormAdd}>
                <FormGroup>
                    <Label for="packet_id">Kode Paket</Label>
                    <Input type="text" name="packet_id" id="packet_id" onChange={this.onChange} value={this.state.packet_id === null ? '' : this.state.packet_id} />
                </FormGroup>
                <FormGroup>
                    <Label for="packet_name">Nama Paket</Label>
                    <Input type="text" name="packet_name" id="packet_name" onChange={this.onChange} value={this.state.packet_name === null ? '' : this.state.packet_name} />
                </FormGroup>
                <FormGroup>
                    <Label for="packet_price">Harga Paket</Label>
                    <Input type="number" name="packet_price" id="packet_price" onChange={this.onChange} value={this.state.packet_price === null ? '' : this.state.packet_price} />
                </FormGroup>
                <Button>Submit</Button>
            </Form>
        );
    }
}

export default PacketForm;